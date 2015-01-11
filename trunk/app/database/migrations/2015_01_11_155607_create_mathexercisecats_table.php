<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathexercisecatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexercisecats', function(Blueprint $table) {
			$table->increments('id');
			$table->string('label', 50)->unique();
			$table->string('description', 500);
			$table->string('template', 500)->nullable();
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
		Schema::drop('mathexercisecats');
	}

}
