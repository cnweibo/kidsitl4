<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCatsubidColumnOnMathskillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathskills', function(Blueprint $table) {
			$table->unsignedInteger('catsubid');
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
			$table->dropColumn('catsubid');
		});
	}

}
