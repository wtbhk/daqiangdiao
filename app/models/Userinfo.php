<?php

class Userinfo extends Eloquent {

        protected $table = 'userinfo';

        protected $primaryKey = 'openid';

        protected $fillable = array('openid', 'nickname', 'sex', 'city', 'country', 
                'province', 'language', 'headimgurl', 'subscribe_time');

}
