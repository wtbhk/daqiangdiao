<?php

Class ListController extends WechatController {

        function showIndex()
        {
                $products = Product::with('images', 'inventory')->rank()->available()->get();  
                return View::make('index', array('products'=>$products));
        }

        function showList()
        {
                $categories = Category::rank()->get();
                $categories = $categories->each(function($category){
                        $category->products = $category->products()->with('images', 'inventory')->new()->available()->get();
                        return $category;
                });
                return View::make('list', array('categories'=>$categories));
        }

        function showChefList()
        {
                $chefs = Chef::rank()->get();
                $chefs = $chefs->each(function($chef){
                        $chef->products = $chef->products()->with('images', 'inventory')->new()->available()->take(3)->get();
                        return $chef;
                });
                return View::make('cheflist', array('chefs'=>$chefs));
        }

}
