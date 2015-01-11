<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathsyntheticalexamrowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathsyntheticalexamrows', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('mathexam_id')->unsigned();
			$table->integer('mathexercise_id')->unsigned();
			$table->integer('subscore')->unsigned();
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
		Schema::drop('mathsyntheticalexamrows');
	}

}
