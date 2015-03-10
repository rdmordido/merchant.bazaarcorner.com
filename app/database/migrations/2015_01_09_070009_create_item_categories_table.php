<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_categories',function($table){
			$table->integer('item_id')->length(10)->unsigned();
			$table->string('category_id')->nullable();
			$table->integer('is_primary')->default(0);
			$table->timestamps();
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_categories');
	}

}
