<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Client extends Model 
{
    use Notifiable;


    protected $table = 'clients';
    public $timestamps = true;
    
    protected $fillable=['name' , 'email' ,'password','status','pin_code','phone'];

    // public function contacts()
    // {
    //     return $this->hasMany('App\Model\Contact');
    // }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }
    

    // public function fatwas()
    // {
    //     return $this->hasMany('App\Models\Fatwas');
    // }

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($data)
{
    $this->notify(new ResetPassword($data));
}
}