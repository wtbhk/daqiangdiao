<?php

class WechatController extends BaseController {

        function __construct()
        {
                if(App::environment('local'))
                        Session::set('openid', 'testopenid');
                if(!Session::has('openid'))
                        throw new Exception;
                $this->wechat_id = Session::get('openid');
                $this->user = User::firstOrCreate(array(
                        'wechat_id'=>$this->wechat_id
                ));
                if(Session::has('wechat_userinfo'))
                {
                        $wechat_user_info = Session::get('wechat_userinfo');
                        $this->wechat_user_info = $wechat_user_info;
                        $userinfo = Userinfo::find($wechat_user_info['openid']);
                        if(!$userinfo) {
                                unset($wechat_user_info['subscribe']);
                                unset($wechat_user_info['remark']);
                                unset($wechat_user_info['groupid']);
                                $userinfo = Userinfo::create($wechat_user_info);
                                $userinfo->save();
                        }
                }
        }

}
