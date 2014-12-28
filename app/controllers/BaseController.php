<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
        
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
                        $this->wechat_user_info = Session::get('wechat_userinfo');
        }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
