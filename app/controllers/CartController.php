<?php

Class CartController extends BaseController {

        function showCart()
        {
                $date = date('Y-m-d');
                $date_ = '';
                $today = false;
                if(Input::has('date')) 
                {
                        $date_ = Input::get('date');
                }
                elseif(Session::has('date'))
                {
                        $date_ = Session::get('date');
                }
                else
                {
                        $date_ = date('Y-m-d');
                        $today = true;
                }
                $date = strtotime($date)>strtotime($date_) ? $date : $date_; 
                Session::set('date', $date);

                $cart = Cart::content();

                return View::make('cart', array(
                        'cart'=>$cart, 
                        'date'=>$date, 
                        'today'=>$today
                );
        }

        function checkCart()
        {
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('msg'=>'Empty cart'));
                if(!(Input::has('today')||Input::has('date')) || !Input::has('items'))
                {
                        return Redirect::to('/cart')->withError(true);
                }
                $date = Input::has('today') ? date('Y-m-d') : Input::get('date');
                if(strtotime($date) < strtotime(date('Y-m-d')))
                {
                        return Redirect::to('/cart')->withErrors(array('Invaild date'));
                }
                Session::set('date', $date);

                $cart = array();
                foreach(Input::get('items') as $item)
                {
                        $product = Product::find($item['id']);
                        if(!$product)
                                return Redirect::to('/cart')->withErrors(array('msg'=>'Error in items'));
                        if(!$product->available)
                                return Redirect::to('/cart')->withErrors(array('msg'=>'More than one product is unavailable'));
                        if(!$product->checkReservation($date))
                                return Redirect::to('/cart')-withErrors(array('msg'=>'Error in reservation'));
                        if(!$product->checkInventory($item['qty'], $date))
                                return Redirect::to('/cart')->withErrors(array('msg'=>'Error in inventory'));
                        $cart[] = array(
                                'id'=>$product->id, 
                                'name'=>$product->title, 
                                'qty'=>$items->qty,
                                'price'=>$product->price
                        );
                }
                Cart::destroy();
                Cart::associate('Product')->add($cart);

                return Redirect::to('/checkorder');

        }

        function editCart()
        {
                $input = Input::only('id', 'qty');
                $validator = Validator::make($input, array(
                        'id'=>'required|integer',
                        'qty'=>'required|integer'
                ));
                if($validator->fails()
                {
                        return Response::json(array('error'=>true));
                }
                if($input['qty']<=0 || !Product::find($input['id']))
                {
                        if(Cart::get($input['id']))
                                Cart::remove($input['id']);
                }
                elseif($product=Product::find($input['id']))
                {
                        if(Cart::get($product->id))
                        {
                                Cart::update($product->id, $input['qty']);
                        }
                        else
                        {
                                Cart::associate('Product')->add(
                                        $product->id,
                                        $product->title,
                                        $input['qty'],
                                        $product->price
                                );
                        }
                }
                return Response::json(array('error'=>false));
        }

}
