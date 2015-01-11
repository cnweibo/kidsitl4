<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillcatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engskillcats', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->string('catlabel',50)->unique();
			$table->string('description',500)->nullable();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('engskillcats', function(Blueprint $table)
		{
			//
		});
	}

}
