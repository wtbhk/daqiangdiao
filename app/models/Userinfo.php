<?php

class Userinfo extends Eloquent {

        protected $table = 'userinfo';

        protected $primaryKey = 'openid';

        protected $fillable = array('*');

}
