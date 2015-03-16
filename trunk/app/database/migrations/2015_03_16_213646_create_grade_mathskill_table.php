<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeMathskillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grade_mathskill', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('grade_id')->unsigned()->index();
			$table->foreign('grade_id')->references('id')->on('grades')->onUpdate('cascade');
			$table->integer('mathskill_id')->unsigned()->index();
			$table->foreign('mathskill_id')->references('id')->on('mathskills')->onUpdate('cascade');
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
		Schema::drop('grade_mathskill');
	}

}
