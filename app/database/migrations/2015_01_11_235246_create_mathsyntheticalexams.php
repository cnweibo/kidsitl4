<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathsyntheticalexams extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathsyntheticalexams', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id')->unsigned();
			$table->string('description', 200);
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
		Schema::drop('mathsyntheticalexams');
	}

}
