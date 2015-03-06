<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merchants',function($table){
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('username')->unique();
			$table->string('password');
			$table->string('address')->nullable();
			$table->string('website')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->rememberToken();
			$table->timestamps();			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('merchants');
	}

}
