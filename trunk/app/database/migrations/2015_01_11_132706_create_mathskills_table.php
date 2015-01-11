<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMathskillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathskills', function(Blueprint $table) {
			$table->increments('id');
			$table->string('skilllabel', 50)->unique();
			$table->string('description', 500);
			$table->integer('skillcat_id');
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
		Schema::drop('mathskills');
	}

}
