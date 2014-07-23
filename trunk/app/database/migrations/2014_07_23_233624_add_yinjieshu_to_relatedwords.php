<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYinjieshuToRelatedwords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relatedwords', function(Blueprint $table) {
			$table->string('yinjieshu');
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
			$table->dropColumn('yinjieshu');
		});
	}

}
