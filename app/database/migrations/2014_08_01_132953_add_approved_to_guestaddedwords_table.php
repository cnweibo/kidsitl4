<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApprovedToGuestaddedwordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('guestaddedwords', function(Blueprint $table) {
			$table->boolean('approved')->default(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('guestaddedwords', function(Blueprint $table) {
			$table->dropColumn('approved');
		});
	}

}
