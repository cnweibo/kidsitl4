<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engskills', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->unsignedInteger('skillcat_id');
			$table->string('skilllabel',50)->unique();
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
		Schema::drop('engskills', function(Blueprint $table)
		{
			//
		});
	}

}
