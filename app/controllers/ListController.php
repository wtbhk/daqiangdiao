<?php

Class ListController extends WechatController {

        function showIndex()
        {
                $products = Product::with('images', 'inventory')->rank()->available()->get();  
                return View::make('index', array('products'=>$products));
        }

        function showList()
        {
                $products = Product::with('images', 'inventory')->new()->available()->get();
                return View::make('list', array('products'=>$products));
        }

        function showChefList()
        {
                $chefs = Chef::rank()->get();
                $chefs = $chefs->each(function($chef){
                        $chef->products = Product::with('images', 'inventory')->new()->available()->get();
                        return $chef;
                });
                return View::make('cheflist', array('chefs'=>$chefs));
        }

}
