<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFatwasTable extends Migration {

	public function up()
	{
		Schema::create('fatwas', function(Blueprint $table) {
			$table->increments('id');
			// $table->integer('client_id')->unsigned();
			$table->string('name');
			$table->string('email');
			$table->text('message');
			$table->boolean('status')->default(1);
			// $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
						
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('fatwas');
	}
}