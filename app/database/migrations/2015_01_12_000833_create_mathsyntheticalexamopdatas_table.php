<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathsyntheticalexamopdatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathsyntheticalexamopdatas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->integer('mathexam_id')->unsigned();
			$table->integer('mathexercise_id')->unsigned();
			$table->string('uanswer', 100);
			$table->string('tf', 20);
			$table->string('timetotal', 50);
			$table->string('comment', 100)->nullable();
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
		Schema::drop('mathsyntheticalexamopdatas');
	}

}
