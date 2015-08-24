<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('username')->unique('username');
			$table->string('email');
			$table->text('password', 65535);
			$table->string('sms', 25);
			$table->timestamps();
			$table->text('remember_token', 65535);
			$table->string('active_code')->nullable();
			$table->boolean('active')->nullable();
			$table->integer('count_fail')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
