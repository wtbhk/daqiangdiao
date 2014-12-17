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
