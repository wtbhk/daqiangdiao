<?php

Class ListController extends BaseController {

        function showIndex()
        {
                $products = Product::with('image', 'inventory')->rank()->available()->get();  
                return View::make('index', array('products'=>$products));
        }

        function showList()
        {
                $products = Product::with('image', 'inventory')->New()->available()->get();
                return View::make('list', array('products'=>$products));
        }

}
