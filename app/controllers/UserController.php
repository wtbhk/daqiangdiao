<?php

Class UserController extends BaseController {

        function showProfile()
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::firstOrCreate(array(
                        'wechat_id'=>$wechat_user_info['openid']
                ))->with('addressee');
                return View::make('profile', array('user'=>$user));
        }

        function editProfile()
        {

        }

        function showPhone()
        {

        }

        function showAddAddress()
        {

        }

        function addAddress()
        {

        }

        function delAddress($id)
        {

        }

        function showOrders()
        {

        }

}
