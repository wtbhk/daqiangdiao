<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                Admin::create(array(
                        'username'=>'admin',
                        'password'=>'admin'
                ));
                $user = User::create(array(
                        'phone'=>12345678900,
                        'nickname'=>'钟无艳Nickname',
                        'name'=>'钟无艳',
                        'wechat_id'=>'testopenid',
                        'balance'=>8500.5
                ));
                for($i=0;$i<7;$i++)
                {
                        Product::create(array(
                                'price'=>20+$i*2,
                                'reservation_day'=>floor($i/3),
                                'inventory_per_day'=>20-$i,
                                'title'=>'商品测试标题'.$i,
                                'description'=>'商品测试描述'.$i,
                                'content'=>'商品测试内容'.$i,
                                'rank'=>floor($i/4)
                        ));
                }
                /*
                for($i=0;$i<20;$i++)
                {
                        $order = Order::create(array(
                                'user_id'=>$user->id,
                                'status'=>1,
                                'addressee'=>'addresseetest',
                                'phone'=>18343432112 + $i,
                                'address'=>'addresstest',
                                'delivery'=>date('Y-m-d')
                        ));
                        for($j=1;$j<5;$j++)
                        {
                                OrderItem::create(array(
                                        'order_id'=>$order->id,
                                        'product_id'=>$j,
                                        'price'=>$j,
                                        'amount'=>$j,
                                        'title'=>'testtitle'.$j,
                                        'image'=>'/images/default.jpg'
                                ));
                        }
                }
                 */
		// $this->call('UserTableSeeder');
	}

}
