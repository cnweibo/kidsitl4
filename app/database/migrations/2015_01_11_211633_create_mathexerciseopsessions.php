<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathexerciseopsessions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexerciseopsessions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('starttime');
			$table->timestamp('endtime');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mathexerciseopsessions');
	}

}
