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
		Schema::create('categories',function($table){
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('parent_id')->length(10)->unsigned();
			$table->integer('is_active')->default(1);
			$table->timestamps();
			$table->foreign('parent_id')->references('id')->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
