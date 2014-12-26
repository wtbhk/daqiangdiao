<?php

Class AdminController extends BaseController {

        function login()
        {
                return View::make('admin.login');
        }

        function checkLogin()
        {
                if(Admin::check())
                        return Redirect::to('/admin');
                $validator = Validator::make(
                        Input::only('username', 'password'),
                        array(
                                'username'=>'required',
                                'password'=>'required'
                        )
                );
                if($validator->fails())
                        return Redirect::to('/admin/login')->withErrors(array('msg'=>'Login failed'));
                if(!Admin::attempt())
                        return Redirect::to('/admin/login')->withErrors(array('msg'=>'Login failed'));
        }

        function setting()
        {

        }

        function product()
        {

        }

        function user()
        {

        }

        function order()
        {

        }
}
