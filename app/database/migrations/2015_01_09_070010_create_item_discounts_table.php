<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDiscountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_discounts',function($table){
			$table->integer('item_id')->length(10)->unsigned();
			$table->integer('discount_id')->length(10)->unsigned();
			$table->timestamps();
			$table->foreign('item_id')->references('id')->on('items');
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
		Schema::drop('item_discounts');
	}

}