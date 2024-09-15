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
Route::get('/events/{event_uid}', 'EventController@show');

Route::get('/หมวดหมู่/{slug}', 'ArticleController@category');
Route::get('/หมวดหมู่/{cate_slug}/{sub_slug}', 'ArticleController@sub_category');

Route::get('/posts', 'ArticleController@index');
Route::get('/posts/{post_uid}', 'ArticleController@show');

Route::get('/services', 'ServiceController@index');
Route::get('/services/{post_uid}', 'ServiceController@show');


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

Route::prefix('/administrator/banner')->group(function () {
    Route::get('/', 'Banner\BannerController@index');
//    Route::get('/load-data', [BannerController::class, 'loadData']);
    Route::get('/create', 'Banner\BannerController@create');
    Route::post('/store', 'Banner\BannerController@store');
    Route::get('/{banner_uid}/edit', 'Banner\BannerController@edit');
    Route::post('/{banner_uid}/update', 'Banner\BannerController@update');
    Route::post('/{banner_uid}/delete', 'Banner\BannerController@delete');
});

Route::prefix('/administrator/service')->group(function () {
    Route::get('/', 'Service\ServiceController@index');
//    Route::get('/load-data', [BannerController::class, 'loadData']);
    Route::get('/create', 'Service\ServiceController@create');
    Route::post('/store', 'Service\ServiceController@store');
    Route::get('/{service_uid}/show', 'Service\ServiceController@show');
    Route::get('/{service_uid}/edit', 'Service\ServiceController@edit');
    Route::post('/{service_uid}/update', 'Service\ServiceController@update');
    Route::post('/{service_uid}/delete', 'Service\ServiceController@delete');

    Route::prefix('/{service_uid}/show/images')->group(function () {
        Route::get('/create', 'Service\ServiceImageController@create');
        Route::post('/store', 'Service\ServiceImageController@store');
        Route::get('/{image_uid}/edit', 'Service\ServiceImageController@edit');
        Route::post('/{image_uid}/update', 'Service\ServiceImageController@update');
        Route::post('/{image_uid}/delete', 'Service\ServiceImageController@delete');
    });
});