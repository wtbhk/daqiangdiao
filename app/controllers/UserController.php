<?php

Class UserController extends WechatController {

        function showProfile()
        {
                $user = $this->user;
                $addressees = Addressee::where(array(
                        'user_id'=>$user->id
                ))->orderBy('created_at', 'desc')->get();
                return View::make('profile.profile', array('user'=>$user, 'addressees'=>$addressees));
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
                $redirect_to = Input::get('redirect_to');
                return View::make('profile.address', array('user'=>$user, 'redirect_to'=>$redirect_to));
        }

        function addAddress()
        {
                $user = $this->user;
                $validator = Validator::make(Input::all(), array(
                        'phone'=>'required|digits_between:7,12',
                        'name'=>'required',
                        'address'=>'required',
                        'redirect_to'=>'sometimes'
                ));
                $addressee = Input::only('name', 'address', 'phone');
                $addressee['user_id'] = $user->id;
                if($validator->fails())
                        return Redirect::to('/address')->withErrors($validator);
                $addressee = $user->addressees()->create($addressee);
                if($user->phone == NULL)
                {
                        $user->phone = $addressee->phone;
                }
                if($user->name == NULL)
                {
                        $user->name = $addressee->name;
                }
                $user->save();
                Session::set('addressee', $addressee->id);
                return Redirect::to(Input::get('redirect_to', '/profile'));
        }

        function delAddress($id)
        {
                $user = $this->user;
                if($user->addressees->contains($id))
                {
                        Addressee::find($id)->delete();
                        return Redirect::to('/profile')->withSuccess('Success');
                }
                return Redirect::to('/profile');
        }

        function showOrders()
        {
                $user = $this->user;
                $orders = Order::with('orderitems')->where('user_id', $user->id)->newest()->get();
                return View::make(
                        'profile.orders', 
                        array('user'=>$user, 'orders'=>$orders)
                );
        }

}
