<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteSkilllabelColumnOnMathskillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathskills', function(Blueprint $table) {
			$table->dropColumn('skilllabel');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('mathskills', function(Blueprint $table) {
			$table->string('skilllabel',50)->unique();
		});
	}
}
