<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders',function($table){
			$table->increments('id');
			$table->integer('merchant_id')->length(10)->unsigned();
			$table->integer('customer_id')->length(10)->unsigned();
			$table->integer('order_status');
			$table->timestamps();
			$table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('customer_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('order_status')->references('code')->on('order_status')->onDelete('no action')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
