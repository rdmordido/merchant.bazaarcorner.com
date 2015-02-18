<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments',function($table){
			$table->increments('id');
			$table->integer('order_id')->length(10)->unsigned();
			$table->decimal('amount',10,2);
			$table->timestamps();
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
