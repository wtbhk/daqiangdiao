<?php

Class ProductController extends WechatController {

        function showProduct($id)
        {
                $rowid = Cart::search(array('id'=>intval($id)));
                $rowid = $rowid[0];
                $product = Cart::get($rowid);
                $qty = $product ? $product->qty : 0;
                $product = Product::find($id);
                if(!$product->available)
                	return Redirect::to('/');
                return View::make('product.product', array('product'=>$product, 'qty'=>$qty));
        }

}
