<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColumnFayinguizeid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relatedwords', function(Blueprint $table)
		{
		    $table->integer('fayinguize_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('relatedwords', function(Blueprint $table)
		{
		    $table->dropColumn('fayinguize_id');
		});
	}

}
