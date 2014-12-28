<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                Setting::set('minimum_amount', 50);
                Admin::create(array(
                        'username'=>'admin',
                        'password'=>'admin'
                ));
                $user = User::create(array(
                        'phone'=>12345678900,
                        'nickname'=>'testnickname',
                        'name'=>'testname',
                        'wechat_id'=>'testopenid',
                        'balance'=>121.5
                ));
                for($i=0;$i<5;$i++)
                {
                        Addressee::create(array(
                                'user_id'=>$user->id,
                                'name'=>$user->name,
                                'address'=>'testaddress'.$i,
                                'phone'=>$user->phone
                        ));
                }
                for($i=0;$i<20;$i++)
                {
                        Product::create(array(
                                'price'=>20,
                                'reservation_day'=>3,
                                'inventory_per_day'=>20,
                                'title'=>'testproduct'.$i,
                                'description'=>'testdescription'.$i,
                                'content'=>'testcontent'.$i,
                                'rank'=>$i
                        ));
                }

		// $this->call('UserTableSeeder');
	}

}
