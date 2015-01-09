<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followers',function($table){
			$table->integer('merchant_id')->length(10)->unsigned();
			$table->integer('user_id')->length(10)->unsigned();
			$table->timestamps();
			$table->foreign('merchant_id')->references('id')->on('merchants');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('followers');
	}

}
