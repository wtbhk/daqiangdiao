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
