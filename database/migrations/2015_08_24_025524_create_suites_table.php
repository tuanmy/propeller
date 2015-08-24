<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('project_id')->unsigned()->index('suites_project_id_foreign');
			$table->integer('tester_id')->unsigned();
			$table->string('tests_path');
			$table->string('file_mask');
			$table->string('command_options');
			$table->integer('retries')->default(0);
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
		Schema::drop('suites');
	}

}
