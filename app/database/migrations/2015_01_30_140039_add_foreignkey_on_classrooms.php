<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignkeyOnClassrooms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			// $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			// $table->dropForeign('classrooms_teacher_id_foreign');
		});
	}

}
