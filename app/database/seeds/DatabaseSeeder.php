<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                $user = User::create(array(
                        'phone'=>12345678909,
                        'nickname'=>'testnickname',
                        'name'=>'testname',
                        'wechat_id'=>'testopenid',
                        'balance'=>121.5
                ));
                for($i=0,$i<20,$i++)
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
