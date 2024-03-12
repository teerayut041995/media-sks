<?php

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

// Route::get('/hello', function () {
//     return view('admin.event.create');
// });

Route::get('/', 'HomeController@index');
Route::get('/article/{slug}', 'HomeController@post_detail');
Route::get('/live', 'LiveController@index');
Route::get('/watch/{id}', 'LiveController@watch');
Route::get('/กิจกรรม', 'HomeController@event');
Route::get('/กิจกรรม/{slug}', 'HomeController@event_detail');
Route::get('/about', 'HomeController@about');
Route::get('/about/history', 'AboutController@history');
Route::get('/about/executive', 'AboutController@executive');
Route::get('/contact', 'AboutController@contact');
Route::get('/events', 'EventController@index');
Route::get('/events/{slug}', 'EventController@show');

Route::get('/หมวดหมู่/{slug}', 'ArticleController@category');
Route::get('/หมวดหมู่/{cate_slug}/{sub_slug}', 'ArticleController@sub_category');

// --------------------------------------- admin route ---------------------------------------//
Route::get('/administrator', 'AdminController@index');
Route::get('/administrator/login', 'AdminLoginController@index');
Route::get('/administrator/logout', 'AdminLoginController@logout');
Route::post('/administrator/checklogin', 'AdminLoginController@checkLogin');

Route::resource('/administrator/user' , 'UserAdminController');

Route::resource('/administrator/category' , 'CategoryController');
Route::get('/administrator/category/active/{id}', 'CategoryController@active');
Route::get('/administrator/category/unactive/{id}', 'CategoryController@unactive');

Route::resource('/administrator/sub-category' , 'SubCategoryController');
Route::get('/administrator/sub-category/active/{id}', 'SubCategoryController@active');
Route::get('/administrator/sub-category/unactive/{id}', 'SubCategoryController@unactive');

Route::resource('/administrator/post' , 'PostController');
Route::post('/administrator/post/load/sub-category' , 'PostController@load_sub_category');
Route::get('/administrator/post/active/{id}', 'PostController@active');
Route::get('/administrator/post/unactive/{id}', 'PostController@unactive');

Route::resource('/administrator/media-embed' , 'MediaEmbedController');
Route::get('/administrator/media-embed/active/{id}', 'MediaEmbedController@active');
Route::get('/administrator/media-embed/unactive/{id}', 'MediaEmbedController@unactive');
Route::get('/administrator/media-embed/start/{id}', 'MediaEmbedController@start');
Route::get('/administrator/media-embed/stop/{id}', 'MediaEmbedController@stop');

Route::resource('/administrator/event' , 'EnentController');
Route::get('/administrator/event/active/{id}', 'EnentController@active');
Route::get('/administrator/event/unactive/{id}', 'EnentController@unactive');
Route::delete('/administrator/event/image/delete/{id}' , 'EnentController@delete_image');
Route::patch('/administrator/event/upload-image/{id}' , 'EnentController@upload_image');