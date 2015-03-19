<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharedordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::Create("sharedorders", function($table)
                {
                        $table->increments("order_id");
                        $table->string("content")->nullable();
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
                Schema::dropIfExists("sharedorders");
	}

}
