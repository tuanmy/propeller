<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assets', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->integer('hrid');
			$table->text('name', 65535);
			$table->text('type', 65535);
			$table->text('format', 65535);
			$table->integer('size');
			$table->string('person_id', 36);
			$table->string('event_id', 36);
			$table->string('organization_id', 36);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assets');
	}

}
