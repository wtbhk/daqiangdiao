<?php

Class UserController extends BaseController {

        function showProfile()
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::firstOrCreate(array(
                        'wechat_id'=>$wechat_user_info['openid']
                ))->with('addressee');
                return View::make('profile.profile', array('user'=>$user));
        }

        function editProfile()
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::where('wechat_id', Session::get($wechat_user_info['openid']))->first();
                $input = Input::only('phone', 'password');
                if(!$input)
                {
                        return Redirect::to('/profile');
                }
                $validator = Validator::make($input, array(
                        'phone'=>'sometimes|digits_between:7,12',
                        'password'=>'sometimes|min:6'
                ));
                if($validator->fails())
                {
                        return Redirect::to('/profile')->withErrors($validator);
                }
                $user->update($input);
                return Redirect::to('/profile');
        }

        function showPhone()
        {
                return View::make('profile.phone')
        }

        function showAddAddress()
        {
                return View::make('profile.address')
        }

        function addAddress()
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::where('wechat_id', Session::get($wechat_user_info['openid']))->first();
                $input = Input::only('name', 'address', 'phone');
                $validator = Validator::make($input, array(
                        'phone'=>'required|digits_between:7,12',
                        'name'=>'required',
                        'address'=>'required'
                ));
                if($validator->fails(){
                        return Redirect::to('/address')->withError($validator);
                }
                $user->addressees()->insert($input);
                return Redirect::to('/profile');    
        }

        function delAddress($id)
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::where('wechat_id', Session::get($wechat_user_info['openid']))->first();
                if(in_array($id, $user->addressees()->pluck('id')))
                {
                        Addressee::find($id)->delete();
                        return Redirect::to('/profile')-withSuccess('Success');
                }
                return Redirect::to('/profile');
        }

        function showOrders()
        {
                $wechat_user_info = Session::get('wechat_userinfo');
                $user = User::where('wechat_id', Session::get($wechat_user_info['openid']))->first();
                $orders = $user->orders()->with('order.orderitems');
                return View::make(
                        'profile.orders', 
                        array('user'=>$user, 'orders'=>$orders)
                );
        }

}
