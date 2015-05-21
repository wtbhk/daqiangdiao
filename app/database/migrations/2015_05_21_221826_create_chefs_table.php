<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChefsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create("chefs", function($table)
		{
			$table->increments("id");
			$table->string("name");
			$table->string("phone");
			$table->string("profile");
			$table->integer("rank")->default(0);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::Create("chef_product", function($table)
		{
			$table->increments("id");
			$table->integer("chef_id");
			$table->integer("product_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("chefs");
		Schema::dropIfExists("chef_product");
	}

}
