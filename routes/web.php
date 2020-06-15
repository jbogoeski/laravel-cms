<?php

use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware('auth')->group(function(){

    Route::get('/admin', 'AdminsController@index')->name('admin.index');
    
    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');

    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::delete('/admin/posts/{post}/delete', 'PostController@destroy')->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');

    Route::put('/admin/users/{user}/update', 'UserController@update')->name('user.profile.update');

    Route::delete('/admin/users/{user}/delete', 'UserController@destroy')->name('user.destroy');
    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
    


});


Route::middleware(['role:admin', 'auth'])->group(function(){

    Route::get('/admin/users', 'UserController@index')->name('users.index');

    Route::put('/admin/users/{user}/attach', 'UserController@attach')->name('users.role.attach');
    Route::put('/admin/users/{user}/detach', 'UserController@detach')->name('users.role.detach');

    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::post('/roles', 'RoleController@store')->name('roles.store');
    Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');
    Route::put('/roles/{role}/attach', 'RoleController@attach_permission')->name('role.permission.attach');
    Route::put('/roles/{role}/detach', 'RoleController@detach_permission')->name('role.permission.detach');

    
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
    Route::post('/permissions', 'PermissionController@store')->name('permissions.store');
    Route::delete('/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
    Route::get('/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::put('/permissions/{permission}/update', 'PermissionController@update')->name('permissions.update');


});

Route::middleware(['can:view,user'])->group(function(){

   

});



