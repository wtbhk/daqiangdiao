<?php

Class ProductController extends BaseController {

        function showProduct($id)
        {
                $product = Product::find($id);
                $product_in_cart = Cart::search(array('id' => $product->id));
                $product_in_cart = Cart::get($product_in_cart[0]);
                $product->in_cart = $product_in_cart ? $product_in_cart->qty : 0;
                return View::make('product.product', array('product'=>$product));
        }

}
