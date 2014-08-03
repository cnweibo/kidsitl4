<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMathsum4exercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathsum4exercises', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('operand1');
			$table->integer('operand2');
			$table->integer('sumdata');
			$table->string('difficulty');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mathsum4exercises');
	}

}