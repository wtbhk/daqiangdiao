<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::Create("users", function($table)
                {
                        $table->increments("id");
                        $table->string("phone");
                        $table->string("password");
                        $table->string("wechat_id");
                        $table->float("balance");
                        $table->string("headimgurl");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("products", function($table)
                {
                        $table->increments("id");
                        $table->float("price");
                        $table->integer("reservation_day");
                        $table->integer("inventory_per_day")
                        $table->boolean("ignore_inventory");
                        $table->string("title");
                        $table->string("description");
                        $table->string("content");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("inventory", function($table)
                {
                        $table->increments("id");
                        $table->integer("product_id");
                        $table->date("date");
                        $table->integer("inventory");
                        $table->timestamps()
                });

                Schema::Create("orders", function($table)
                {
                        $table->increments("id");
                        $table->integer("user_id");
                        $table->integer("status");
                        $table->string("addressee");
                        $table->string("phone");
                        $table->string("address");
                        $table->dateTime("delivery");
                        $table->timestamps();
                });

                Schema::Create("orderitems", function($table)
                {
                        $table->increments("id");
                        $talbe->integer("product_id");
                        $table->integer("order_id");
                        $table->string("title");
                        $table->string("description");
                        $table->string("content");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("images", function($table)
                {
                        $table->increments("id");
                        $table->string("file");
                        $table->string("description");
                        $table->morphs("imageable");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("videos", function($table)
                {
                        $table->increments("id");
                        $table->integer("product_id");
                        $table->string("file");
                        $table->string("description");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("addressees", function($table)
                {
                        $table->increments("id");
                        $table->integer("user_id");
                        $table->string("address");
                        $table->string("name");
                        $table->string("phone");
                        $table->timestamps();
                        $table->softDeletes();
                });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::dropIfExists("User");
                Schema::dropIfExists("Product");
                Schema::dropIfExists("Inventory");
                Schema::dropIfExists("Order");
                Schema::dropIfExists("OrderItem");
                Schema::dropIfExists("Image");
                Schema::dropIfExists("Video");
                Schema::dropIfExists("Addressee");
	}

}
