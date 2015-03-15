<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompositeuniqueOnMathskillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathskills', function(Blueprint $table) {
			$table->unique(array('mathskillcat_id','catsubid'));
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
			$table->dropUnique('mathskills_mathskillcat_id_catsubid_unique');
		});
	}

}
