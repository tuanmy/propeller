<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRunsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('runs', function(Blueprint $table)
		{
			$table->foreign('test_id')->references('id')->on('tests')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('runs', function(Blueprint $table)
		{
			$table->dropForeign('runs_test_id_foreign');
		});
	}

}
