<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYinbiaoIdToFayinguizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fayinguizes', function(Blueprint $table)
		{
		    $table->integer('yinbiao_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fayinguizes', function(Blueprint $table)
		{
		    $table->dropColumn('yinbiao_id');
		});
	}

}
