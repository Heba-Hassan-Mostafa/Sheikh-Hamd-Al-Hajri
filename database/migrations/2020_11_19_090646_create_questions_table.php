<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('fatwas_id')->unsigned();			
			$table->longText('answer')->nullable();
			$table->string('mp3File')->nullable();
			$table->date('publish_date');
			$table->foreign('fatwas_id')->references('id')->on('fatwas')
					->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}