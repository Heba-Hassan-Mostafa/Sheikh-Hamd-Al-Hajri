<?php 

//Setting fun
if(!function_exists('setting'))
{
    function setting()
    {
        return  \App\Models\Setting::orderBy('id' , 'desc')->first();
    }

}

//live fun
if(!function_exists('live'))
{
    function live()
    {
        return  \App\Models\Live::orderBy('id' , 'desc')->first();
    }

}



// function to validate image

if(!function_exists('validateImage'))
{
    function validateImage($ext = null)
    {
      if($ext == null)
      {
         return 'image|mimes:png,jpg,jpeg,gif,bmp';
      }else
      {
        return 'image|mimes:'. $ext;
      }
    }

}

//uploadimages  fun
if(!function_exists('up'))
{
    function up()
    {
      return new \App\Http\Controllers\WebController\UploadController;
    }

}

  


// function to control name of url admin/

use GuzzleHttp\Psr7\Request;

if(!function_exists('adminUrl'))
{
    function adminUrl($url = null)
    {
        return url('admin/'.$url);
    }

}

  // dropdown menu when select of its li is active
  if(!function_exists('activeMenu'))
{
    function activeMenu($link)
    {
        if(preg_match('/'.  $link.'/i' ,  request()->segment(2)))
        {
          return ['menu-open' , 'display:block'];
          
        }else
        {
          return ['',''];
        }
    }

}
  

// session lang
if (!function_exists('lang')) 
    {
      function lang()
      {
        if(session()->has('lang'))
        {
            return session('lang');
        }
        else
        {
           return 'ar';
        }
      }
    }


    //direction of design 
    if (!function_exists('direction'))
     {
        function direction()
       {
           if (session()->has('lang')) 
         {    
          if (session('lang') == 'ar') 
            {
           return 'rtl';
           }
           else
           {
            return 'ltr';
           }
           }
           
           else
           {
            return 'rtl';
        }
           
       }
       
    }


    //datatable lang
    if (!function_exists('datatable_lang')) {
    
      function datatable_lang()
      {
        return
        [
                        'sProcessing'     => trans('admin/template/common.sProcessing'),
                        'sLengthMenu'     => trans('admin/template/common.sLengthMenu'),
                        'sZeroRecords'    => trans('admin/template/common.sZeroRecords'),
                        'sEmptyTable'     => trans('admin/template/common.sEmptyTable'),
                        'sInfo'           => trans('admin/template/common.sInfo'),
                        'sInfoEmpty'      => trans('admin/template/common.sInfoEmpty'),
                        'sInfoFiltered'   => trans('admin/template/common.sInfoFiltered'),
                        'sInfoPostFix'    => trans('admin/template/common.sInfoPostFix'),
                        'sSearch'         => trans('admin/template/common.sSearch'),
                        'sUrl'            => trans('admin/template/common.sUrl'),
                        'sInfoThousands'  => trans('admin/template/common.sInfoThousands'),
                        'sLoadingRecords' => trans('admin/template/common.sLoadingRecords'),
                        'oPaginate'       => [
                            'sFirst'         => trans('admin/template/common.sFirst'),
                            'sLast'          => trans('admin/template/common.sLast'),
                            'sNext'          => trans('admin/template/common.sNext'),
                            'sPrevious'      => trans('admin/template/common.sPrevious'),
                        ],
                        'oAria'            => [
                            'sSortAscending'  => trans('admin/template/common.sSortAscending'),
                            'sSortDescending' => trans('admin/template/common.sSortDescending'),
                        ],
          
        ];
        
      }
    }



      // session lang
if (!function_exists('getYoutubeId')) 
    {
      function getYoutubeId($url)
      {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? $match[1] : null;
      }
    }