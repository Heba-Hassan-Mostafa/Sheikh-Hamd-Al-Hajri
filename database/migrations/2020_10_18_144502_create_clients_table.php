<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('password');
			$table->string('email')->unique();
			 $table->string('phone');
			$table->boolean('status')->default(1);
			$table->string('pin_code')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}