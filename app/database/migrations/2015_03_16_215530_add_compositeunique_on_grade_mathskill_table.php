<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompositeuniqueOnGradeMathskillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('grade_mathskill', function(Blueprint $table) {
			$table->unique(array('mathskill_id','grade_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('grade_mathskill', function(Blueprint $table) {
			$table->dropUnique('grade_mathskill_mathskill_id_grade_id_unique');
		});
	}

}
