<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestaddedwordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guestaddedwords', function(Blueprint $table) {
			$table->increments('id');
			$table->string('wordtext');
			$table->integer('fayinguizeid');
			$table->integer('yinbiaoid');
			$table->string('addedby');
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
		Schema::drop('guestaddedwords');
	}

}
