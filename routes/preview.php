<?php

use Illuminate\Support\Facades\Route;

Route::get('/preview/home', 'HomePreviewController@index')->name('preview.home');
Route::get('/preview/about/{page}', 'AboutController@preview')
    ->where('page', 'history|executive')->name('preview.about');
Route::get('/preview/contact', 'AboutController@previewContact')->name('preview.contact');
Route::get('/preview/events', 'EventController@previewIndex')->name('preview.events');
Route::get('/preview/posts', 'ArticleController@previewIndex')->name('preview.posts');
Route::get('/preview/article/{post_uid}', 'ArticleController@previewShow')
    ->where('post_uid', '[0-9]+')->name('preview.article.show');
Route::get('/preview/events/{event_uid}', 'EventController@previewShow')
    ->where('event_uid', '[0-9]+')->name('preview.events.show');
Route::get('/preview/services', 'ServiceController@previewIndex')->name('preview.services');
Route::get('/preview/services/{service_uid}', 'ServiceController@previewShow')
    ->where('service_uid', '[0-9]+')->name('preview.services.show');
Route::get('/preview/{kind}/{id}', 'HomePreviewController@show')
    ->where(['kind' => 'posts|events', 'id' => '[0-9]+'])->name('preview.content');
