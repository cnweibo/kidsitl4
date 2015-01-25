<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteOrgniaztionColumnOnTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teachers', function(Blueprint $table) {
			$table->dropColumn('orgnization');
			$table->string('organization',100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('teachers', function(Blueprint $table) {
			$table->dropColumn('organization');
			$table->string('orgnization',100);
		});
	}

}
