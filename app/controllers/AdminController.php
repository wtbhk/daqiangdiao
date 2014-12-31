<?php

Class AdminController extends BaseController {

        function login()
        {
                return View::make('admin.login');
        }

        function checkLogin()
        {
                if(Admin::check())
                        return Redirect::to('/admin');
                $validator = Validator::make(
                        Input::only('username', 'password'),
                        array(
                                'username'=>'required',
                                'password'=>'required'
                        )
                );
                if($validator->fails())
                        return Redirect::to('/admin/login')->withErrors(array('msg'=>'Login failed'));
                if(!Admin::attempt())
                        return Redirect::to('/admin/login')->withErrors(array('msg'=>'Login failed'));
        }

        function setting()
        {
                $settings = Setting::all();
                return View::make('admin.settings', array('settings'=>$settings)); 
        }

        function product()
        {
                $products = Product::all();
                return View::make('admin.products', array('products'=>$products));
        }

        function editProduct()
        {
                $input = Input::only('id', 'price', 'reservation_day', 'inventory_per_day', 'ignore_inventory', 'title', 'description', 'content', 'rank');
                $validator = Validator::make($input, array(
                        'price'=>'required|numeric',
                        'reservation_day'=>'integer',
                        'inventory_per_day'=>'required|integer',
                        'ignore_inventory'=>'boolean',
                        'title'=>'required|max:16',
                        'description'=>'max:28',
                        'rank'=>'integer'
                ));
                if($validator->fails())
                        return Response::json(array('error'=>true, 'fails'=>$validator->failed()));
                if(Input::has('id'))
                {
                        $product = Product::find($input['id']);
                        if(!$product)
                                return Response::json(array('error'=>true));
                        $product->update($input);
                }
                else
                {
                        $product = Product::create($input);
                }
                return Response::json(array('error'=>false, 'product'=>$product->toArray()));

        }


        function deleteProduct($id)
        {
                Product::destroy($id);
                return Response::json(array('error'=>false));
        }

        function addImage($id)
        {
                $validator = Validator::make(Input::only('image'),array(
                        'image'=>'required|image'
                ));
                if(! $product = Product::find($id))
                        return Response::json(array('error'=>true));
                if(!Input::file('image')->isValid())
                        return Response::json(array('error'=>true));
                $file = Input::file('image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move('/uploads/', $filename);
                $product->image->create(array(
                        'file'=>'/uploads/'.$filename
                ));
                return Response::json(array('error'=>false, 'image'=>'/uploads/'.$filename));
        }

        function deleteImage($pid, $iid)
        {
                $image = Image::find($iid);
                if(!$image or $image->product->id != $pid)
                        return Response::json(array('error'=>true));
                $image->delete();
                        return Response::json(array('error'=>false, 'image'=>$iid));
        }


        function user()
        {
                $users = User::all();
                return View::make('admin.users', array('users'=>$users));
        }

        function order()
        {
                return View::make('admin.orders');
        }

        function orderNew()
        {
                $order = Order::with('OrderItems')->where('status', Order::OPEN)->first();
                if($order)
                        return Response::json($order->toArray());
                return Response::json(array('error'=>true));
        }

        function orderStatus($id, $status)
        {
                $status = strtoupper($status);
                $order = Order::find($id);
                if($order)
                        $order->status = Order::$status;
                return Response::json(array('error'=>false));
        }

        function orderToday()
        {
                $orders = Order::with('OrderItems')
                        ->where(DB::raw('to_days(delivery) = to_days(now())'))
                        ->get(); 
                return Response::json($orders->toArray());
        }

        function orderAll()
        {
                $orders = Order::with('OrderItems')->orderBy('created_at', 'desc')->take(50)->get();
                return Response::json($orders->toArray());
        }

}
