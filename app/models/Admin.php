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

        static function attempt($arr)
        {
                if(Admin::where(array(
                        'username'=>$arr['username'],
                        'password'=>$arr['password']
                ))->first())
                {
                        Session::set('admin', $arr['username']);
                        return true;
                }
                return false;
        }


}
