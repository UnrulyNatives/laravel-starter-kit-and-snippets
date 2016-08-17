<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('starter.landing');
// });
    Route::get('/', 'Starter\StarterController@landing');


Route::get('logout', 'Auth\LoginController@logout');



/////////////////////
// STARTER
/////////////////////
// This group would prevend interference of the UN Laravel Starter routes with your own routes
Route::group(['prefix' => 'starter','middleware' => ['setTheme:bootstrap']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type


    Route::get('frontend', function () {
        return view('starter.frontend.components_common');
    });
    Route::get('features', 'Starter\StarterController@features');
    Route::get('packages', 'Starter\StarterController@packages');
    Route::get('minitools', 'Starter\StarterController@minitools');
    Route::get('snippets', 'Starter\StarterController@snippets');
    Route::get('landing', 'Starter\StarterController@landing');
    Route::get('admintools', 'Starter\AdminToolsController@dashboard_admintools');


    Route::get('admintools/remove-status-null/{itemkind?}', 'Starter\AdminToolsController@remove_status_null');

    Route::get('admintools/user-track/{user?}', 'Starter\AdminToolsController@user_track');


    Route::get('admintools/assign-roles/{user?}/{role?}', 'Starter\AdminToolsController@assign_roles');



});



//package Resources
/********************* package ***********************************************/
Route::resource('package','\App\Http\Controllers\PackageController');
Route::post('package/{id}/update','\App\Http\Controllers\PackageController@update');
Route::get('package/{id}/delete','\App\Http\Controllers\PackageController@destroy');
Route::get('package/{id}/deleteMsg','\App\Http\Controllers\PackageController@DeleteMsg');
/********************* package ***********************************************/


//feature Resources
/********************* feature ***********************************************/
Route::resource('feature','\App\Http\Controllers\FeatureController');
Route::post('feature/{id}/update','\App\Http\Controllers\FeatureController@update');
Route::get('feature/{id}/delete','\App\Http\Controllers\FeatureController@destroy');
Route::get('feature/{id}/deleteMsg','\App\Http\Controllers\FeatureController@DeleteMsg');
/********************* feature ***********************************************/


/////////////////////
// ADMIN WITH PREFIX
/////////////////////

Route::group(['prefix' => 'admin','middleware' => ['setTheme:semanticui']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

            Route::get('/', '\Starter\AdminController@index');


            Route::get('dashboard-caretaker', 'UserWorkspacesController@dashboard_caretaker');


        Route::get('dashboard-alerts', 'Starter/AdminToolsController@dashboard_alerts');
        Route::get('dashboard-admintools', 'Starter/AdminToolsController@index');
        Route::get('dashboard-volunteers-caretakers', 'AdminToolsController@dashboard_volunteers_caretakers');



});



/////////////////////
// ADMIN WITH NO PREFIX
/////////////////////

Route::group(['middleware' => ['admins','setTheme:semanticui']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type



    Route::get('dashboard_users', 'Starter\AdminController@dashboard_users');



});

    Route::get('user-track/{userid}', 'AdminToolsController@user_track');

    // user roles
    Route::get('assign_roles_to_Peter', 'AdminToolsController@assign_roles');




/////////////////////
// ADMIN WITH PREFIX
/////////////////////

Route::group(['prefix' => 'admin','middleware' => ['setTheme:semanticui']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

            Route::get('/', 'AdminController@index');
    Route::get('server-status', 'Starter\AdminToolsController@server_status');

            Route::get('dashboard-caretaker', 'UserWorkspacesController@dashboard_caretaker');


        Route::get('dashboard-alerts', 'AdminToolsController@dashboard_alerts');
        Route::get('dashboard-admintools', 'AdminToolsController@index');
        Route::get('dashboard-volunteers-caretakers', 'AdminToolsController@dashboard_volunteers_caretakers');



});



/////////////////////
// ADMIN WITH NO PREFIX
/////////////////////

Route::group(['middleware' => ['admins','setTheme:DeLaPaz']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type



    Route::get('dashboard_users', 'AdminController@dashboard_users');



});

    Route::get('user-track/{userid}', 'AdminToolsController@user_track');

    // user roles
    Route::get('assign_roles_to_Peter', 'AdminToolsController@assign_roles');


    // user roles
    Route::get('experiments/gravatar', 'StarterController@experiments_gravatar');






Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');





Route::get('set_theme/{themeName}', 'Starter\UserWorkspacesController@set_theme');