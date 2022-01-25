<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiosTable extends Migration {

	public function up()
	{
		Schema::create('audios', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->unique();
			$table->string('embedLink')->nullable();
			$table->string('audioFile')->nullable(); 
			$table->date('publish_date');
			$table->integer('view_count')->default(0);
			$table->integer('download_count')->default(0);
			$table->integer('audioable_id');
			$table->string('audioable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('audios');
	}
}