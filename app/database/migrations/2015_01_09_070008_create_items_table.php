<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items',function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('sku')->unique();
			$table->text('description')->nullable();
			$table->decimal('price',10,2);
			$table->integer('brand_id')->length(10)->unsigned()->nullable();
			$table->integer('merchant_id')->length(10)->unsigned();
			$table->integer('discount_id')->length(10)->unsigned()->nullable();
			$table->timestamps();
			$table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('merchant_id')->references('id')->on('merchants');
			$table->foreign('discount_id')->references('id')->on('discounts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('items');
	}

}
