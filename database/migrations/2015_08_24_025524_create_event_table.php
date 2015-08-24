<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->text('name', 65535);
			$table->text('description', 65535);
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->text('type', 65535);
			$table->text('person_attending', 65535);
			$table->text('gifts', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event');
	}

}
