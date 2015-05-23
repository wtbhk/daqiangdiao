<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('categories', function($table)
		{
			$table->increments('id');
			$table->string('text')->unique();
			$table->timestamps();
		});

		Schema::table('products', function(Blueprint $table)
		{
			$table->integer('category_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("categories");
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('category_id');
		});
	}

}
