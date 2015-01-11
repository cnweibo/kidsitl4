<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathexercisedifficulties extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexercisedifficulties', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('mathskill_id')->unsigned();
			$table->integer('difficultyrank')->unsigned();
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
		Schema::drop('mathexercisedifficulties');
	}

}
