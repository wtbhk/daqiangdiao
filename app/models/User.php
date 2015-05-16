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
                User::saving(function($user)
                {
                        if(Session::has('wechat_userinfo'))
                        {
                                $wechat_user_info = Session::get('wechat_userinfo');
                                if(isset($wechat_user_info['headimgurl']) && $wechat_user_info['headimgurl'])
                                        $user->headimgurl = substr($wechat_user_info['headimgurl'], 0, -1) . "96";
                                if(isset($wechat_user_info['nickname']) && $wechat_user_info['nickname'])
                                        $user->nickname = $wechat_user_info['nickname'];
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

        function userinfo()
        {
                return $this->hasOne('Userinfo', 'openid', 'wechat_id');
        }

        function scopeNewest($query)
        {
                return $query->orderBy('created_at', 'desc');
        }

}
