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
                        $table->string("phone")->nullable();
                        $table->string("password")->nullable();
                        $table->string("wechat_id")->unique();
                        $table->float("balance")->default(0);
                        $table->string("headimgurl")->nullable();
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("products", function($table)
                {
                        $table->increments("id");
                        $table->boolean("available")->default(true);
                        $table->float("price");
                        $table->integer("reservation_day");
                        $table->integer("inventory_per_day");
                        $table->boolean("ignore_inventory")->default(false);
                        $table->string("title");
                        $table->string("description")->nullable();
                        $table->string("content")->nullable();
                        $table->integer("rank")->default(0);
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("inventory", function($table)
                {
                        $table->increments("id");
                        $table->integer("product_id");
                        $table->date("date");
                        $table->integer("inventory");
                        $table->timestamps();
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
                        $table->integer("product_id");
                        $table->integer("order_id");
                        $table->string("title");
                        $table->string("description")->nullable();
                        $table->string("content")->nullable();
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("images", function($table)
                {
                        $table->increments("id");
                        $table->string("file");
                        $table->string("description")->nullable();
                        $table->morphs("imageable");
                        $table->timestamps();
                        $table->softDeletes();
                });

                Schema::Create("videos", function($table)
                {
                        $table->increments("id");
                        $table->integer("product_id");
                        $table->string("file");
                        $table->string("description")->nullable();
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
