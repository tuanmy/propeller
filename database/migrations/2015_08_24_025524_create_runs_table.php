<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRunsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('runs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('test_id')->unsigned()->index('runs_test_id_foreign');
			$table->boolean('was_ok');
			$table->text('log', 65535);
			$table->text('html', 65535)->nullable();
			$table->text('png', 65535)->nullable();
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
		Schema::drop('runs');
	}

}
