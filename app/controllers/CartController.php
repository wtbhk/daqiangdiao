<?php

Class CartController extends BaseController {

        function showCart()
        {
                $date = date('Y-m-d');
                $date_ = '';
                if(Input::get('today')=='false')
                {
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
                        }
                        if(strtotime($date) >= strtotime($date_))
                        {
                                $today = true;
                                $date = $date;
                        }
                        else
                        {
                                $today = false;
                                $date = $date_;
                        }
                }
                else
                {
                        $date = date('Y-m-d');
                        $today = true;
                }

                Session::set('date', $date);

                $cart = Cart::content();
                foreach($cart as $item)
                {
                        if(!$item->product)
                        {
                                Cart::destroy();
                                $cart = array();
                                break;
                        }

                }

                return View::make('cart', array(
                        'cart'=>$cart, 
                        'date'=>$date, 
                        'today'=>$today
                ));
        }

        function checkCart()
        {
                if(Cart::total()==0)
                        return Redirect::to('/cart')->withErrors(array('message'=>'购物车是空的'));

                if(!(Input::has('today')||Input::has('date')) || !Input::has('items'))
                {
                        return Redirect::to('/cart')->withErrors(array('message'=>'未知错误'));
                }
                $date = Input::has('today') ? date('Y-m-d') : Input::get('date');
                if(strtotime($date) < strtotime(date('Y-m-d')))
                {
                        return Redirect::to('/cart')->withErrors(array('message'=>'日期有误'));
                }
                Session::set('date', $date);

                $cart = array();
                foreach(Input::get('items') as $item)
                {
                        if($item['qty']==0)
                        {
                                break;
                        }
                        $product = Product::find($item['id']);
                        if(!$product)
                                return Redirect::to('/cart')->withErrors(array('message'=>'商品失效'));
                        if(!$product->available)
                                return Redirect::to('/cart')->withErrors(array('message'=>'商品已下架'));
                        if(!$product->checkReservation($date))
                                return Redirect::to('/cart')->withErrors(array('message'=>'超过一件商品需要提前预订'));
                        if(!$product->checkInventory($item['qty'], $date))
                                return Redirect::to('/cart')->withErrors(array('message'=>'库存不足'));
                        $cart[] = array(
                                'id'=>$product->id, 
                                'name'=>$product->title, 
                                'qty'=>$item['qty'],
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
                if($validator->fails())
                {
                        return Response::json(array('error'=>true, 'msg'=>'非法参数'));
                }
                if($input['qty']<=0 || !Product::find($input['id']))
                {
                        $rowid = Cart::search(array('id'=>$input['id']));
                        if($rowid)
                                Cart::remove($rowid[0]);
                }
                elseif(Product::find($input['id']))
                {
                        $product = Product::find($input['id']);
                        $rowid = Cart::search(array('id'=>$product->id));
                        $rowid = $rowid ? $rowid[0] : NULL;
                        if(Cart::get($rowid))
                        {
                                Cart::update($rowid, $input['qty']);
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

        function deleteCart()
        {
                Cart::destroy();
                return Response::json(array('error'=>false));
        }

}
