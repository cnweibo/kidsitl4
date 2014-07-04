<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFayinguizeIdNullableOnRelatedwords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relatedwords', function(Blueprint $table)
		{
			//
			$table->dropColumn('fayinguize_id');
		});
		Schema::table('relatedwords', function(Blueprint $table)
		{
			//
			$table->integer('fayinguize_id')->nullable();
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
			//
			$table->dropColumn('fayinguize_id');
		});
		Schema::table('relatedwords', function(Blueprint $table)
		{
			//
			$table->integer('fayinguize_id');
		});
	}

}
