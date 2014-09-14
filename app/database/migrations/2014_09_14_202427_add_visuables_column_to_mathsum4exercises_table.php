<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisuablesColumnToMathsum4exercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathsum4exercises', function(Blueprint $table) {
			$table->string('invisualcolumns')->default('3');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mathsum4exercises', function(Blueprint $table) {
			$table->dropColumn('invisualcolumns');
		});
	}

}