<?php

Class OrderController extends BaseController {

        function showAddressee()
        {
                $user = $this->user;
                $addressees = Addressee::where('user_id', $user->id)->get();
                if(Session::has('addressee') and in_array(Session::get('addressee'), $addressees->pluck('id')))
                        $checked = Session::get('addressee');
                $checked = $addressees ? $addressees[0]['id'] : '';
                return View::make('orderaddr', array('addressees'=>$addressees, 'checked'=>$checked));  
        }

        function editAddressee()
        {
                $user = $this->user;
                if(!Input::has('id'))
                        return Response::json(array('error'=>true));
                if(!Addressee::where(array(
                        'user_id'=>$user->id,
                        'id'=>Input::get('id')
                ))->first())
                {
                        return Response::json(array('error'=>true));
                }
                Session::set('addressee', Input::get('id'));
                return Response::json(array('error'=>false));
        }

        function showOrder($id)
        {
                $user = $this->user;
                $order = $user->orders->where('id', $id);
                if(!$order)
                        return Redirect::to('/profile')->withErrors(array('msg'=>'Permissoin denied'));
                return View::make('order', array('user'=>$user, 'order'=>$order));
        }


        function showCheckOrder()
        {
                $user = $this->user;
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Empty cart'));
                $addressee = Session::has('addressee') ?
                        Addressee::find(Session::get('addressee')) : Addressee::where('user_id', $user->id)->first();
                $date = Session::get('date');
                $price = Cart::total();
                $cart = Cart::content();
                $date = Session::get('date');
                return View::make('checkorder', array(
                        'user'=>$user,
                        'addressee'=>$addressee,
                        'cart'=>$cart,
                        'price'=>$price,
                        'balance'=>$user->balance,
                        'date'=>$date
                )); 
        }

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
                $addressee=Addressee::find(Input::get('addressee'));
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
                                if(!$item->product->checkReservation(Session::get('date')))
                                        throw new Exception;
                                $order->orderitems->create(array(
                                        'product_id'=>$item->product->id,
                                        'price'=>$item->product->price,
                                        'amount'=>$item->qty,
                                        'image'=>$item->product->one_image_url(),
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
