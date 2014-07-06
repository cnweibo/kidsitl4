<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelatedsentenceRelatedwordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relatedsentence_relatedword', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('relatedsentence_id')->unsigned()->index();
			$table->foreign('relatedsentence_id')->references('id')->on('relatedsentences')->onDelete('cascade');
			$table->integer('relatedword_id')->unsigned()->index();
			$table->foreign('relatedword_id')->references('id')->on('relatedwords')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('relatedsentence_relatedword');
	}

}
