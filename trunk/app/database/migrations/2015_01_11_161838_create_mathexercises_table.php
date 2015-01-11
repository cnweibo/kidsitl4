<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathexercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexercises', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('mathskill_id');
			$table->integer('mathexercisecat_id');
			$table->string('questioncontent', 1000);
			$table->string('answer', 500);
			$table->integer('mathexercisedifficulty_id');
			$table->string('hintforanswering', 500);
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
		Schema::drop('mathexercises');
	}

}
