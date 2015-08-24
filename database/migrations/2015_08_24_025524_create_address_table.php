<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('address', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->integer('number');
			$table->text('street', 65535);
			$table->text('city', 65535);
			$table->text('state', 65535);
			$table->text('postal', 65535);
			$table->text('region', 65535);
			$table->text('country', 65535);
			$table->string('person_id', 36);
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
		Schema::drop('address');
	}

}
