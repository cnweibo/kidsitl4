<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnFayinguizeIdOnFayinguizes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relatedwords', function(Blueprint $table) {
			$table->dropColumn('fayinguize_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('relatedwords', function(Blueprint $table) {
			$table->integer('fayinguize_id');
		});
	}

}
