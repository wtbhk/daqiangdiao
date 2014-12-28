<?php

Class ProductController extends BaseController {

        function showProduct($id)
        {
                $product = Product::find($id);
                $product_in_cart = Cart::get($product->id);
                $product->in_cart = $product_in_cart ? $product_in_cart['qty'] : 0;
                return View::make('product.product', array('product'=>$product));
        }

}
