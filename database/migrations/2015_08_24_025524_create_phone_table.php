<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phone', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->enum('type', array('0','1','2','3','4'));
			$table->string('person_id', 36);
			$table->string('organization_id', 36);
			$table->integer('country_code');
			$table->integer('area_code');
			$table->integer('number');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('phone');
	}

}
