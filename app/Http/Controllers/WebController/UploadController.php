<?php

namespace App\Http\Controllers\WebController;
use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
   public function upload($data = [])
   {
      if(in_array('new_name' , $data))
      {
        $new_name = $data['new_name'] === null ? time() : $data['new_name'];
      }

      if(request()->hasFile($data['file']) && $data['upload_file'] == 'single')
      {
         Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
         return request()->file($data['file'])->store($data['path']);
      }
      
   }
}