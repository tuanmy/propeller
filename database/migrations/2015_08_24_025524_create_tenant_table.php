<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tenant', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->text('org_name', 65535);
			$table->integer('owners');
			$table->text('billing_contact', 65535);
			$table->text('billing_address', 65535);
			$table->text('billing_email', 65535);
			$table->text('address', 65535);
			$table->text('subscription', 65535);
			$table->text('purchases', 65535);
			$table->text('billing_history', 65535);
			$table->text('billing_method', 65535);
			$table->timestamps();
			$table->string('org_id', 36)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tenant');
	}

}
