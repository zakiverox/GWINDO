<?php



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('hello', 'App\Http\Controllers\HomeController@test');
    $api->get('user/{user_id}/role/{role_name}', 'App\Http\Controllers\HomeController@attachUserRole');
    $api->get('user/{user_id}/role', 'App\Http\Controllers\HomeController@getUserRole');

    $api->post('role/permission/add', 'App\Http\Controllers\HomeController@attachPermission');
    $api->get('role/{role_name}/permissions', 'App\Http\Controllers\HomeController@getPermissions');

    $api->post('auth', 'App\Http\Controllers\Auth\LoginController@authenticate');
    $api->post('register', 'App\Http\Controllers\Auth\LoginController@register');
    $api->post('logout', 'App\Http\Controllers\Auth\LoginController@logout');
});

$api->version('v1',['middleware' => 'jwt.auth', 'jwt.refresh','transform.input'] ,function ($api) {
    $api->get('user', 'App\Http\Controllers\Auth\LoginController@show');
    $api->get('token', 'App\Http\Controllers\Auth\LoginController@getToken');
    
    //Product
  
    
   
  
  
    ///==========================================================================================================

    //Guide

    $api->put('guide/profile','App\Http\Controllers\Guide\GuidePrfolieController@update');//ok
    $api->post('guide/product', 'App\Http\Controllers\product\ProductController@create');//ok
    $api->post('guide/product/{product_id}/upload', 'App\Http\Controllers\product\ProductController@uploadimages');//ok
    $api->get('guide/profile','App\Http\Controllers\Guide\GuidePrfolieController@index');//ok
    $api->get('guide/product/{product_id}', 'App\Http\Controllers\product\ProductController@show');//ok
    $api->get('guide/product', 'App\Http\Controllers\product\ProductController@index');//ok

    ///==========================================================================================================
});
