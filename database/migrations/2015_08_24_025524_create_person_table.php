<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('person', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->integer('hrid');
			$table->text('firstname', 65535);
			$table->text('middle', 65535);
			$table->text('lastname', 65535);
			$table->string('phone', 25);
			$table->string('tenant_id', 36);
			$table->string('user_id', 36);
			$table->string('gift_id', 36);
			$table->string('event_id', 36);
			$table->string('family_id', 36);
			$table->text('type', 65535);
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
		Schema::drop('person');
	}

}
