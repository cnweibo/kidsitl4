<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveColumnOnMathskillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathskills', function(Blueprint $table) {
			$table->dropColumn('skillcat_id');
			$table->integer('mathskillcat_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mathskills', function(Blueprint $table) {
			$table->dropColumn('mathskillcat_id');
			$table->integer('skillcat_id');
		});
	}

}
