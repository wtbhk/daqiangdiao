<?php

Class ChefController extends WechatController {

        function showChef($id)
        {
                $chef = Chef::with('products')->find($id);
                if(!$chef)
                	return Redirect::to('/');
                return View::make('chef', array('chef'=>$chef));
        }

}
