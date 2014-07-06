<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFayinguizeRelatedwordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fayinguize_relatedword', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('fayinguize_id')->unsigned()->index();
			$table->foreign('fayinguize_id')->references('id')->on('fayinguizes')->onDelete('cascade');
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
		Schema::drop('fayinguize_relatedword');
	}

}
