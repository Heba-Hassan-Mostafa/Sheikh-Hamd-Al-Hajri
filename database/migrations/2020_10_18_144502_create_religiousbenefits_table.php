<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReligiousBenefitsTable extends Migration {

	public function up()
	{
		Schema::create('religiousbenefits', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->index();
			$table->integer('category_id')->unsigned();
			$table->mediumText('content');
			$table->date('publish_date');
			$table->string('slug')->unique();
			 $table->integer('view_count')->default(0);
			$table->boolean('status')->default(1);
			$table->string('keywords');
			$table->longtext('description');
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('religiousBenefits');
	}
}