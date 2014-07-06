<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableMp3InRelatedsentenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relatedsentences', function(Blueprint $table)
		{
			//
			$table->dropColumn('mp3');
		});
		Schema::table('relatedsentences', function(Blueprint $table)
		{
			//
			$table->string('mp3')->nullable();
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('relatedsentences', function(Blueprint $table)
		{
			//
			$table->dropColumn('mp3');
		});
		Schema::table('relatedsentences', function(Blueprint $table)
		{
			//
			$table->string('mp3');
		});	
	}

}
