<?php

Class OrderController extends BaseController {

        function showOrder($id)
        {
                $user = $this->user;
                $order = $user->orders->where('id', $id);
                if(!$order)
                        return Redirect::to('/profile')->withErrors('msg'=>'Permissoin denied');
                return View::make('order', array('user'=>$user, 'order'=>$order);
        }


        function showCheckOrder()
        {
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Empty cart'));
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::where('wechat_id', $wechat_user_info['openid'])->first();
                $addressee = Addressee::where('user_id', $user->id)->first();
                $date = Session::get('date');
                $price = Cart::total();
                $cart = Cart::content();
                return View::make('checkorder', array(
                        'user'=>$user,
                        'addressee'=>$addressee,
                        'cart'=>$cart,
                        'price'=>$price,
                        'balance'=>$user->balance
                )); 
        }
]
        function checkOrder()
        {
                $user = $this->user;
                $validator = Validator::make(array(
                        Input::only('payment', 'addressee'),
                        'payment'=>'required|in:cash,balance',
                        'addressee'=>'required|integer'
                ));
                if($validator->fails())
                        return Redirect::to('/checkorder')->withErrors($validator);
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Empty cart'));
                if(!Session::has('date') || strtotime(Session::get('date'))<strtotime(date('Y-m-d')))
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Date error'));
                $addressee=Addressee::find(Input::get('addressee'))
                if(!$addressee)
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Addressee error'));
                $cart = Cart::content();
                DB::beginTransaction();
                try{
                        $order = Order::create(array(
                                'user_id'=>$user->id,
                                'status'=>Order::OPEN,
                                'addressee'=>$addressee->name,
                                'phone'=>$addressee->phone,
                                'address'=>$addressee->address,
                                'delivery'=>$date
                        ));
                        foreach($cart as $item)
                        {
                                if(!$item->product->checkInventory($item->qty, Session::get('date')))
                                        throw new Exception;
                                $order->orderitems->create(array(
                                        'product_id'=>$item->product->id,
                                        'order_id'=>$order->id,
                                        'title'=>$item->product->title,
                                        'description'=>$item->product->description,
                                        'content'=>$item->product->content
                                ));
                                if(!$item->product->ignore_inventory)
                                {
                                        $item->product->iventory = $item->product->inventory - $item->qty;
                                        $item->save();
                                }
                        }
                        if(Input::get('payment')=='balance')
                        {
                                $user = User::find($user->id)->lockForUpdate();
                                if($user->balance < Cart::total())
                                        throw new Exception;
                                $user->balance = $user->balance - Cart::total();
                                $user->save();
                        }
                }catch(Exception $e){
                        return Redirect::to('/checkorder')->withErrors('Order error');
                }
                Session::forget('date');
                Cart::destroy(); 
                return Redirect::to('/order/'.$order->id);
        }
}
