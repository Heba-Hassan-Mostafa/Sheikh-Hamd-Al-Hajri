<?php

namespace App\Models;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
   protected $table = 'files';
   
   protected $fillable =
   [
       'name',
       'size',
       'file',
       'path',
       'full_file',
       'mime_type',
       'file_type',
       'relation_id',       
   ];
}