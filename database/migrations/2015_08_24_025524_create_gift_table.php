<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGiftTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gift', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->integer('hrid');
			$table->text('name', 65535);
			$table->float('market_value', 10, 0);
			$table->text('person', 65535);
			$table->string('event_id', 36);
			$table->text('type', 65535);
			$table->float('taxt_value', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gift');
	}

}
