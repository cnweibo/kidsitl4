<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRegexColumnInFayinguizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fayinguizes', function(Blueprint $table) {
			$table->string('regex');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fayinguizes', function(Blueprint $table) {
			$table->dropColumn('regex');
		});
	}

}
