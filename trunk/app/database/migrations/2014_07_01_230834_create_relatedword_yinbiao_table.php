<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelatedwordYinbiaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relatedword_yinbiao', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('relatedword_id')->unsigned()->index();
			$table->foreign('relatedword_id')->references('id')->on('relatedwords')->onDelete('cascade');
			$table->integer('yinbiao_id')->unsigned()->index();
			$table->foreign('yinbiao_id')->references('id')->on('yinbiaos')->onDelete('cascade');
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
		Schema::drop('relatedword_yinbiao');
	}

}
