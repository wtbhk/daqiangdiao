<?php

class Admin extends Eloquent {

	protected $table = 'admin';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        static function check()
        {
                if(Session::has('admin'))
                        return true;
                return false;
        }

        static function attempt()
        {
                if(Admin::where(array(
                        'username'=>Input::get('username'),
                        'password'=>Input::get('password')
                ))->first())
                {
                        Session::set('admin', Input::get('username'));
                        return true;
                }
                return false;
        }


}
