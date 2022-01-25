<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{

	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {

			$table->increments('id');
			$table->string('siteName')->nullable();
			$table->string('logo')->nullable();
			$table->string('icon')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('facebook_url')->nullable();
			$table->string('youtube_url')->nullable();
			$table->string('twitter_url')->nullable();
			$table->string('instagram_url')->nullable();
			$table->string('telegram_url')->nullable();
			$table->string('site_right')->nullable();
			$table->string('blog')->nullable();
			$table->string('main_languge')->default('ar');
			$table->longtext('about_sheikh')->nullable();
			$table->string('keywords')->nullable();
			$table->longtext('description')->nullable();
			$table->enum('status', ['open', 'close'])->default('open');
			$table->longtext('message_maintenance')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}