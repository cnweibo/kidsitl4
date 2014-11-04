<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreTimeconsumedToMathexamsTable extends Migration {

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathexams', function(Blueprint $table) {
			$table->smallInteger('score')->nullable();
			$table->string('timeconsumed')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mathexams', function(Blueprint $table) {
			$table->dropColumn('score');
			$table->dropColumn('timeconsumed');
		});
	}
}