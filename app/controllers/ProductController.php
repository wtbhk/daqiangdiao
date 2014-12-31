<?php

Class ProductController extends BaseController {

        function showProduct($id)
        {
                $rowid = Cart::search(array('id'=>$id));
                $rowid = $rowid[0];
                $product = Cart::get($rowid);
                $qty = $product ? $product->qty : 0;
                $product = Product::find($id);
                return View::make('product.product', array('product'=>$product, 'qty'=>$qty));
        }

}
