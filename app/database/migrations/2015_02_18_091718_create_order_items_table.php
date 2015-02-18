<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items',function($table){
			$table->integer('order_id')->length(10)->unsigned();
			$table->integer('item_id')->length(10)->unsigned();
			$table->integer('quantity');
			$table->decimal('price',10,2);
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('item_id')->references('id')->on('items')->onDelete('no action')->onUpdate('cascade');
			$table->primary(array('order_id','item_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_items');
	}

}
