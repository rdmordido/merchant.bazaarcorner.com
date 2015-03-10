<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discounts',function($table){
			$table->increments('id');
			$table->integer('merchant_id')->length(10)->unsigned();
			$table->string('title')->unique();
			$table->dateTime('start');
			$table->dateTime('end');
			$table->string('type');
			$table->float('rate')->nullable();
			$table->decimal('price',10,2)->nullable();
			$table->string('image')->nullable();
			$table->string('description')->nullable();
			$table->integer('is_active')->default(1);
			$table->timestamps();
			$table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discounts');
	}

}
