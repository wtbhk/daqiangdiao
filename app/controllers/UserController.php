<?php

Class UserController extends BaseController {

        function showProfile()
        {
                $user = $this->user;
                return View::make('profile.profile', array('user'=>$user));
        }

        function editProfile()
        {
                $user = $this->user;
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
                return View::make('profile.phone', array('user'=>$this->user));
        }

        function showAddAddress()
        {
                $user = $this->user;
                return View::make('profile.address', array('user'=>$user));
        }

        function addAddress()
        {
                $user = $this->user;
                $input = Input::only('name', 'address', 'phone');
                $validator = Validator::make($input, array(
                        'phone'=>'required|digits_between:7,12',
                        'name'=>'required',
                        'address'=>'required'
                ));
                if($validator->fails()){
                        return Redirect::to('/address')->withError($validator);
                }
                $user->addressees()->insert($input);
                return Redirect::to('/profile');    
        }

        function delAddress($id)
        {
                $user = $this->user;
                if(in_array($id, $user->addressees()->pluck('id')))
                {
                        Addressee::find($id)->delete();
                        return Redirect::to('/profile')-withSuccess('Success');
                }
                return Redirect::to('/profile');
        }

        function showOrders()
        {
                $user = $this->user;
                $orders = $user->orders()->with('orderitems');
                return View::make(
                        'profile.orders', 
                        array('user'=>$user, 'orders'=>$orders)
                );
        }

}
