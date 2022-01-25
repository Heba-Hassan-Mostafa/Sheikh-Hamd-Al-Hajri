<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table    = 'settings';
	public $timestamps = true;
    
	protected $fillable = [
		'siteName',
		'logo',
		'icon',
		'email',
		'phone',
        'instagram_url',
        'facebook_url',
        'youtube_url',
		'twitter_url',
		'telegram_url',
		'about_sheikh',
		'keywords',
		'description',
		'status',
		'message_maintenance',
		'main_languge',
		'site_right',
		'woman_phone',
        
	];
}