<?php

Class ListController extends BaseController {

        function showIndex()
        {
                products = Product::with('image', 'inventory')->rank()->get();  
                return View::make('index', array('products'=>products));
        }

        function showList()
        {
                products = Product::with('image', 'inventory')->New()->get();
                return View::make('list', array('products'=>products));
        }

}
