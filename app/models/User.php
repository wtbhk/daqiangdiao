<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

        use UserTrait, RemindableTrait;

        protected $table = 'users';

        protected $hidden = ['password'];
        
        protected $guarded = ['id'];

        protected $softDelete = true;

        static function boot()
        {
                parent::boot();
                User::creating(function($user)
                {
                        if(!$user->headimgurl and Session::has('wechat_userinfo'))
                        {
                                $wechat_user_info = Session::get('wehcat_userinfo');
                                $user->headimgurl = $wechat_user_info['headimgurl'];
                        }
                        if(!$user->nickname)
                        { 
                                if($user->name)
                                {
                                        $user->nickname = $user->name;
                                }
                                elseif(Session::has('wechat_userinfo'))
                                {
                                        $userinfo = Session::get('wechat_userinfo');
                                        $user->nickname = $userinfo['nickname'];
                                }

                        }
                });
        }

        function orders()
        {
                return $this->hasMany('Order');
        }

        function addressees()
        {
                return $this->hasMany('Addressee');
        }

        function getBalanceAttribute($balance)
        {
                return number_format($balance, 1, '.', '');
        }


}
