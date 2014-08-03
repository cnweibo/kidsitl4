<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setoperand1plus2uniqueOnMathsum4exercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mathsum4exercises', function($t) {
        $t->unique(['operand1','operand2']);
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mathsum4exercises', function($t) {
                $t->dropUnique(['operand1','operand2']);
        });
	}

}
