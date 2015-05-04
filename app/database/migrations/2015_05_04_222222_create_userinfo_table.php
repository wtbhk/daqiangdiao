<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::Create("userinfo", function($table)
                {
                        $table->string("openid")->primary();
                        $table->string("nickname")->nullable();
                        $table->integer("sex")->nullable();
                        $table->string("city")->nullable();
                        $table->string("country")->nullable();
                        $table->string("province")->nullable();
                        $table->string("language")->nullable();
                        $table->string("headimgurl")->nullable();
                        $table->timestamp("subscribe_time")->nullable();
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
                Schema::dropIfExists("userinfo");
	}

}
