<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration {

	public function up()
	{
		Schema::create('videos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->unique();
			$table->string('youtubeLink')->nullable();
			$table->integer('videoable_id');
			$table->string('videoable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('videos');
	}
}