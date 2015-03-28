<?php

Class OrderController extends BaseController {

        function showAddressee()
        {
                $user = $this->user;
                $addressees = Addressee::where('user_id', $user->id)->lastused()->get();
                if(Session::has('addressee') and $addressees->contains(Session::get('addressee')))
                        $checked = Session::get('addressee');
                else
                        $checked = $addressees->first() ? $addressees->first()->id : '';
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
                $order = Order::find($id);
                if($order->user_id!=$user->id)
                        return Redirect::to('/');
                if(!$order)
                        return Redirect::to('/profile')->withErrors(array('message'=>'权限不足'));
                return View::make('order', array('user'=>$user, 'order'=>$order));
        }

        function showShareOrder($id)
        {
                $user = $this->user;
                $order = Order::find($id);
                $is_owner = ($order->user_id == $user->id) ? true : false;
                $sharedorder = SharedOrder::find($id);
                if($is_owner && !$sharedorder)
                        return View::make('profile.sharedorder', array(
                                'is_owner'=>$is_owner,
                                'shared'=>false, 
                                'image'=>false, 
                                'content'=>false, 
                                'orderitems'=>$order->orderitems
                        ));
                if($sharedorder)
                        return View::make('profile.sharedorder', array(
                                'is_owner'=>$is_owner,
                                'shared'=>true, 
                                'image'=>$sharedorder->last_image(), 
                                'content'=>$sharedorder->content, 
                                'orderitems'=>$sharedorder->orderitems
                        ));
                return Redirect::to('/')->withErrors(array('message'=>'非法参数'));
        }

        function editShareOrder($id)
        {
                $order = Order::find($id);
                if($order->user_id != $this->user->id)
                        return Redirect::to('/')->withErrors(array('message'=>'非法操作'));
                $sharedorder = SharedOrder::firstOrCreate(array('order_id'=>$order->id));
                $validator = Validator::make(
                        Input::only(array('content', 'image')),
                        array('content'=>'max:40')
                );
                if($validator->fails())
                {
                        return Redirect::action('OrderController@showShareOrder', array('id' => $order->id));
                }
                if(Input::has('content') && Input::get('content')!='')
                        $sharedorder->content = Input::get('content');
                if(Input::file('image'))
                {
                        $file = Input::file('image');
                        $filename = time().'.'.$file->getClientOriginalExtension();
                        $file->move('uploads/', $filename);
                                Image::create(array(
                                'file'=>'/uploads/'.$filename,
                                'imageable_id'=>$sharedorder->order_id,
                                'imageable_type'=>'SharedOrder'
                        ));
                }
                $sharedorder->save();
                return Redirect::action('OrderController@showShareOrder', array('id' => $order->id));
        }

        function showCheckOrder()
        {
                $user = $this->user;
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('message'=>'购物车是空的'));
                $addressee = Session::has('addressee') ?
                        Addressee::find(Session::get('addressee')) : Addressee::where('user_id', $user->id)->lastused()->first();
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
                $validator = Validator::make(
                        Input::only('payment', 'addressee'),
                        array(
                                'payment'=>'required|in:cash,balance',
                                'addressee'=>'required|integer'
                        )
                );
                if($validator->fails())
                        return Redirect::to('/checkorder')->withErrors($validator);
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('message'=>'购物车是空的'));
                if(!Session::has('date') || strtotime(Session::get('date'))<strtotime(date('Y-m-d')))
                        return Redirect::to('/cart')->withErrors(array('message'=>'日期有误'));
                $addressee = Addressee::find(Input::get('addressee'));
                if(!$addressee)
                        return Redirect::to('/cart')->withErrors(array('message'=>'地址有误'));
                $cart = Cart::content();
                DB::beginTransaction();
                try{
                        $order = Order::create(array(
                                'user_id'=>$user->id,
                                'status'=>Order::OPEN,
                                'addressee'=>$addressee->name,
                                'phone'=>$addressee->phone,
                                'address'=>$addressee->address,
                                'delivery'=>Session::get('date')
                        ));
                        foreach($cart as $item)
                        {
                                if($item->qty==0)
                                        break;
                                if(!$item->product->checkInventory($item->qty, Session::get('date')))
                                        throw new Exception('库存不足');
                                if(!$item->product->checkReservation(Session::get('date')))
                                        throw new Exception('超过一件商品需要提前预订');
                                OrderItem::create(array(
                                        'order_id'=>$order->id,
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
                                        $date = Session::get('date');
                                        $inventory = $item->product->inventory_in($date);
                                        $inventory->inventory = $inventory->inventory - $item->qty;
                                        $inventory->save();
                                }
                        }
                        if(Input::get('payment')=='balance')
                        {
                                $user = User::lockForUpdate()->find($user->id);
                                if($user->balance < Cart::total())
                                        throw new Exception('余额不足');
                                $user->balance = $user->balance - Cart::total();
                                $user->save();
                        }
                        DB::commit();
                }catch(Exception $e){
                        DB::rollback();
                        return Redirect::to('/checkorder')->withErrors(array('message'=>$e->getMessage()));
                }
                Session::forget('date');
                Cart::destroy(); 
                return Redirect::to('/orders');
        }
}
