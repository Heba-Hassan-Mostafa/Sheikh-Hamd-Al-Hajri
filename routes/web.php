<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');

// });



           

    // Route::get('/home',function(){
    //     return redirect()->to('/admin/home');
    // });

    // Auth::routes(['register'=>false]);
    Route::group(['prefix' => 'admin'], function() {
    // Admin Authentication Routes... 
Route::get('/login',                            ['as' => 'show_login_form',                 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login',                            ['as' => 'login',                           'uses' => 'Auth\LoginController@login']);
//Logout
Route::any('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset',                    ['as' => 'password.request',                'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email',                   ['as' => 'password.email',                  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}',            ['as' => 'password.reset',                  'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset',                   ['as' => 'password.update',                 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('email/verify',                      ['as' => 'verification.notice',             'uses' => 'Auth\VerificationController@show']);
Route::get('/email/verify/{id}/{hash}',         ['as' => 'verification.verify',             'uses' => 'Auth\VerificationController@verify']);
Route::post('email/resend',                     ['as' => 'verification.resend',             'uses' => 'Auth\VerificationController@resend']);
});
    // language
    Route::get('lang/{lang}', function ($lang) 
    {
        
        session()->has('lang')?session()->put('lang','ar'):'';
        $lang == 'ar'?session()->put('lang','ar'):session()->put('lang','en') ;
        return back();
    });
      

        Route::group(['middleware'=>['auth','auto-check-permission'] ,'prefix' => 'admin'],function() {

        Route::get('/home', 'HomeController@index')->name('home');
        
          
        Route::any('/notifications/get', 'WebController\NotificationsController@getNotifications');
        Route::any('/notifications/read', 'WebController\NotificationsController@markAsRead');
        Route::any('/notifications/read/{id}', 'WebController\NotificationsController@markAsReadAndRedirect');

    
        // User reset password
        Route::get('user/change-password', 'WebController\UserController@changePassword')->name('user.change-password');
        Route::post('user/change-password', 'WebController\UserController@changePasswordSave');
        Route::get('user/info', 'WebController\UserController@edit_info')->name('user.info');
        Route::post('user/info', 'WebController\UserController@update_info');
         Route::get('user/change', 'WebController\UserController@change')->name('user/change');
        Route::resource('user', 'WebController\UserController');
        Route::delete('user/destroy/all', 'WebController\UserController@multiDelete')->name('user.destroy.all');
        


        
     
        //Clients
        Route::get('client/change', 'WebController\ClientController@change')->name('client/change');
        Route::resource('client', 'WebController\ClientController');
        Route::delete('client/destroy/all', 'WebController\ClientController@multiDelete')->name('client.destroy.all');

        //Contacts
        Route::get('contact/change', 'WebController\ContactController@change')->name('contact/change');
        Route::resource('contact', 'WebController\ContactController');
        Route::delete('contact/destroy/all', 'WebController\ContactController@multiDelete')->name('contact.destroy.all');
        
    
        //categories
        Route::resource('category', 'WebController\CategoryController');
        Route::delete('category/destroy/all', 'WebController\CategoryController@multiDelete')->name('category.destroy.all');

        //Lessons
        Route::resource('lesson', 'WebController\LessonController');
        Route::delete('lesson/destroy/all', 'WebController\LessonController@multiDelete')->name('lesson.destroy.all');
        

        //Lectures
        Route::resource('lecture', 'WebController\LectureController');
        Route::delete('lecture/destroy/all', 'WebController\LectureController@multiDelete')->name('lecture.destroy.all');



        //Speeches
        Route::resource('speech', 'WebController\SpeechController');
        Route::delete('speech/destroy/all', 'WebController\SpeechController@multiDelete')->name('speech.destroy.all');


        //Articles
        Route::resource('article', 'WebController\ArticleController');
        Route::delete('article/destroy/all', 'WebController\ArticleController@multiDelete')->name('article.destroy.all');
        
         //Books
        Route::resource('book', 'WebController\BookController');
        Route::delete('book/destroy/all', 'WebController\BookController@multiDelete')->name('book.destroy.all');


        //ReligiousBenefits
        Route::resource('religious-benefits', 'WebController\ReligiousBenefitsController');
        Route::delete('religious-benefits/destroy/all', 'WebController\ReligiousBenefitsController@multiDelete')->name('religious-benefits.destroy.all');

        //Fatwas
        Route::get('fatwas/change', 'WebController\FatwasController@change')->name('fatwas/change');
        Route::resource('fatwas', 'WebController\FatwasController');
        Route::delete('fatwas/destroy/all', 'WebController\FatwasController@multiDelete')->name('fatwas.destroy.all');
        
       


        
        //Videos
        Route::resource('video', 'WebController\VideoController');
        Route::delete('video/destroy/all', 'WebController\VideoController@multiDelete')->name('video.destroy.all');
        
        //Audios
        Route::resource('audio', 'WebController\AudioController');
        Route::delete('audio/destroy/all', 'WebController\AudioController@multiDelete')->name('audio.destroy.all');


        //Roles
        Route::resource('role','WebController\RoleController');
        Route::delete('role/destroy/all', 'WebController\RoleController@multiDelete')->name('role.destroy.all');

        //Live
        Route::resource('settings', 'WebController\SettingController');

            //Live
        Route::resource('live', 'WebController\LiveController');
        //Sheikh News
        Route::resource('news', 'WebController\SheikhNewsController');

         //subcribers
        Route::resource('subcriber', 'WebController\SubscribeController');
        Route::delete('subcriber/destroy/all', 'WebController\SubscribeController@multiDelete')->name('subcriber.destroy.all');

        //Question
        Route::resource('answer', 'WebController\QuestionController');
        Route::delete('answer/destroy/all', 'WebController\QuestionController@multiDelete')->name('answer.destroy.all');


          //Slider
          Route::get('slider/change', 'WebController\SliderImageController@change')->name('slider/change');
          Route::resource('slider', 'WebController\SliderImageController');
          Route::delete('slider/destroy/all', 'WebController\SliderImageController@multiDelete')->name('slider.destroy.all');
     
        
        


    
    });
    
    


//Route::get('/home', 'HomeController@index')->name('home');






//Frontend Routes



    Route::get('maintenance', function () {

    if (setting()->status == 'open') {
        return redirect('/');
    }

    return view('frontend.design.maintenance');
});


Route::group(['middleware' => 'Maintenance'], function () {

   //index
Route::get('/',                                       ['as' => 'frontend.index'       ,                      'uses' => 'FrontendController\IndexController@index']);


//Authentication Routes...
Route::get('/login',                                ['as' => 'frontend.login_form',                      'uses' => 'FrontendController\Authentcation\LoginController@loginForm']);
Route::post('login',                                ['as' => 'frontend.do_login',                        'uses' => 'FrontendController\Authentcation\LoginController@do_login']);
Route::post('logout',                               ['as' => 'frontend.do_logout',                       'uses' => 'FrontendController\Authentcation\LoginController@do_logout']);
Route::get('register',                              ['as' => 'frontend.register_form',                   'uses' => 'FrontendController\Authentcation\RegisterController@registrationForm']);
Route::post('register',                             ['as' => 'frontend.do_register',                     'uses' => 'FrontendController\Authentcation\RegisterController@do_register']);
Route::get('reset/password',                        ['as' => 'frontend.password.request',                'uses' => 'FrontendController\Authentcation\ForgotPasswordController@showRequestForm']);
Route::post('password/email',                       ['as' => 'frontend.password.email',                  'uses' => 'FrontendController\Authentcation\ForgotPasswordController@sendResetEmail']);
Route::get('update/password',                       ['as' => 'frontend.password.reset',                  'uses' => 'FrontendController\Authentcation\ResetPasswordController@resetForm']);
Route::post('update/password',                      ['as' => 'frontend.password.update',                 'uses' => 'FrontendController\Authentcation\ResetPasswordController@reset']);


//fatwas-index
Route::post('/fatwas',                                          ['as' => 'frontend.add_fatwas',                                 'uses' => 'FrontendController\IndexController@add_fatwas']);


//about sheikh
Route::get('/about-sheikh',                                     ['as' => 'frontend.about.sheikh',                               'uses' => 'FrontendController\IndexController@about_sheikh']);


//fatwas-index
Route::post('/subscribe',                                          ['as' => 'frontend.add_subscribe',                                 'uses' => 'FrontendController\IndexController@subscribe']);

//contact-us
Route::get('/contact-us',                                       ['as' => 'frontend.contacts.contact-us',                        'uses' => 'FrontendController\IndexController@contact']);
Route::post('/contact-us',                                      ['as' => 'frontend.do_contact',                                 'uses' => 'FrontendController\IndexController@do_contact']);

//ive
Route::get('/live',                                             ['as' => 'frontend.live-air.live',                              'uses' => 'FrontendController\IndexController@live_air']);
Route::get('/live-sound',                                        ['as' => 'frontend.live-air.live-sound',                              'uses' => 'FrontendController\IndexController@live_sound']);


Route::group(['prefix' => 'lessons'], function () {
   //category-lessons
Route::get('/category/{category_slug}',                         ['as' => 'frontend.category.lessons',                           'uses' => 'FrontendController\MainController@category_lesson']);
Route::get('/lesson',                                           ['as' => 'frontend.lessons.lessons',                            'uses' => 'FrontendController\MainController@lesson']);
Route::get('/{lesson}',                                         ['as' => 'frontend.lessons.lesson-show',                        'uses' => 'FrontendController\MainController@lesson_show']);


    });

Route::group(['prefix' => 'library'], function () {
    //videos
Route::get('/videos',                                           ['as' => 'frontend.videos.all-videos',                             'uses' => 'FrontendController\MainController@video']);
//audios
Route::get('/audio',                                           ['as' => 'frontend.audios.all-audios',                             'uses' => 'FrontendController\MainController@audio']);
Route::get('/{audio}',                                         ['as' => 'frontend.audios.audio-content',                          'uses' => 'FrontendController\MainController@audio_content']);

});


Route::group(['prefix' => 'religious-benefits'], function () {
   //religious-benefits
Route::get('/category/{category_slug}',            ['as' => 'frontend.category.benefits',                           'uses' => 'FrontendController\MainController@category_benefit']);
Route::get('/benefits',                               ['as' => 'frontend.religious-benefits.benefits',                'uses' => 'FrontendController\MainController@benefit']);
Route::get('/{benefits}',                             ['as' => 'frontend.religious-benefits.content',                 'uses' => 'FrontendController\MainController@benefit_show']);

   });

   Route::group(['prefix' => 'lectures'], function () {
    //religious-benefits
 Route::get('/category/{category_slug}',               ['as' => 'frontend.category.lectures',                            'uses' => 'FrontendController\MainController@category_lecture']);
 Route::get('/lecture',                               ['as' => 'frontend.lectures.lectures',                             'uses' => 'FrontendController\MainController@lecture']);
 Route::get('/{lecture}',                             ['as' => 'frontend.lectures.lecture-content',                      'uses' => 'FrontendController\MainController@lecture_show']);
 
    });

Route::group(['prefix' => 'speeches'], function () {
    //religious-benefits
    Route::get('/category/{category_slug}',               ['as' => 'frontend.category.speeches',                            'uses' => 'FrontendController\MainController@category_speech']);
    Route::get('/speech',                               ['as' => 'frontend.speeches.speeches',                             'uses' => 'FrontendController\MainController@speech']);
    Route::get('/{speech}',                             ['as' => 'frontend.speeches.speech-content',                      'uses' => 'FrontendController\MainController@speech_show']);
    
    });


        
Route::group(['prefix' => 'articles'], function () {
    //religious-benefits
    Route::get('/category/{category_slug}',               ['as' => 'frontend.category.articles',                            'uses' => 'FrontendController\MainController@category_article']);
    Route::get('/article',                               ['as' => 'frontend.articles.articles',                             'uses' => 'FrontendController\MainController@article']);
    Route::get('/{article}',                             ['as' => 'frontend.articles.article-content',                      'uses' => 'FrontendController\MainController@article_show']);
    
    });

Route::group(['prefix' => 'books-researches'], function () {
    //religious-benefits
    Route::get('/category/{category_slug}',           ['as' => 'frontend.category.books',                      'uses' => 'FrontendController\MainController@category_book']);
    Route::get('/book',                               ['as' => 'frontend.books.books',                             'uses' => 'FrontendController\MainController@book']);
    Route::get('/{book}',                             ['as' => 'frontend.books.book-content',                      'uses' => 'FrontendController\MainController@book_show']);
    
    });

 Route::group(['prefix' => 'question-answers'], function () {
    //question-answers
 Route::get('/question',                               ['as' => 'frontend.answers.qustions',                        'uses' => 'FrontendController\MainController@question']);
 Route::get('/answer/{id}',                             ['as' => 'frontend.answers.answers-content',                 'uses' => 'FrontendController\MainController@answer']);
 
    });
   

//search-index
Route::get('/search',                                          ['as' => 'frontend.search',                                      'uses' => 'FrontendController\IndexController@search']);


Route::feeds();

});