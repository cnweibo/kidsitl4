<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMathexamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexams', function(Blueprint $table) {
			$table->increments('id');
			$table->text('exerciseids');
			$table->string('exercisetab');
			$table->string('requestby')->nullable();
			$table->string('difficultydata')->nullable();
			$table->string('commentsbyteacher')->nullable();
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
		Schema::drop('mathexams');
	}

}