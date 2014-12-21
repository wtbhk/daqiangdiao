<?php

Class ProductController extends BaseController {

        function showProduct($id)
        {
                $product = Product::find($id)->with('video')->with('image');
                return View::make('product.product', array('product'=>$product);
        }

}
