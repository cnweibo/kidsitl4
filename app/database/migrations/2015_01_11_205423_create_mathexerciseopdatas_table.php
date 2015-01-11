<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathexerciseopdatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexerciseopdatas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->integer('mathskill_id')->unsigned();
			$table->integer('mathexercise_id')->unsigned();
			$table->integer('mathexerciseopsession_id')->unsigned();
			$table->string('uanswer', 500);
			$table->string('TF', 20);
			$table->string('teachercomment', 200);
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
		Schema::drop('mathexerciseopdatas');
	}

}
