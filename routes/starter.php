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


// example - using functions in routes file
// Route::get('/', function () {
//     return view('starter.landing');
// });


// comment this route to make the `/` route in 'web.php' be first to read
Route::get('/', 'Starter\StarterController@landing');

// manual login: return to initial location, using username and/or email
Route::get('login2', 'Starter\Auth\AuthController@login2');
Route::post('login2', 'Starter\Auth\AuthController@authenticate');

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
    Route::get('initial-setup', 'Starter\StarterController@initial_setup');
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
Route::resource('package','\App\Http\Controllers\Starter\PackageController');
Route::post('package/{id}/update','\App\Http\Controllers\Starter\PackageController@update');
Route::get('package/{id}/delete','\App\Http\Controllers\Starter\PackageController@destroy');
Route::get('package/{id}/deleteMsg','\App\Http\Controllers\Starter\PackageController@DeleteMsg');
/********************* package ***********************************************/


//feature Resources
/********************* feature ***********************************************/
Route::resource('feature','\App\Http\Controllers\Starter\FeatureController');
Route::post('feature/{id}/update','\App\Http\Controllers\Starter\FeatureController@update');
Route::get('feature/{id}/delete','\App\Http\Controllers\Starter\FeatureController@destroy');
Route::get('feature/{id}/deleteMsg','\App\Http\Controllers\Starter\FeatureController@DeleteMsg');
/********************* feature ***********************************************/

//user_setting Resources
/********************* user_setting ***********************************************/
Route::resource('user_setting','\App\Http\Controllers\Starter\User_settingController');
Route::post('user_setting/{id}/update','\App\Http\Controllers\Starter\User_settingController@update');
Route::get('user_setting/{id}/delete','\App\Http\Controllers\Starter\User_settingController@destroy');
Route::get('user_setting/{id}/deleteMsg','\App\Http\Controllers\Starter\User_settingController@DeleteMsg');
/********************* user_setting ***********************************************/


//setting Resources
/********************* setting ***********************************************/
Route::resource('setting','\App\Http\Controllers\Starter\SettingController');
Route::post('setting/{id}/update','\App\Http\Controllers\Starter\SettingController@update');
Route::get('setting/{id}/delete','\App\Http\Controllers\Starter\SettingController@destroy');
Route::get('setting/{id}/deleteMsg','\App\Http\Controllers\Starter\SettingController@DeleteMsg');
/********************* setting ***********************************************/


/////////////////////
// ADMIN WITH PREFIX
/////////////////////

Route::group(['prefix' => 'admin','middleware' => ['setTheme:semantic']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

            Route::get('/', 'Starter\AdminController@index');


            Route::get('dashboard-caretaker', 'UserWorkspacesController@dashboard_caretaker');


        Route::get('dashboard-alerts', 'Starter/AdminToolsController@dashboard_alerts');
        Route::get('dashboard-admintools', 'Starter/AdminToolsController@index');
        Route::get('dashboard-volunteers-caretakers', 'AdminToolsController@dashboard_volunteers_caretakers');



});



/////////////////////
// ADMIN WITH NO PREFIX
/////////////////////

Route::group(['middleware' => ['admins','setTheme:semantic']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type



    Route::get('dashboard_users', 'Starter\AdminController@dashboard_users');



});

    Route::get('user-track/{userid}', 'AdminToolsController@user_track');

    // user roles
    Route::get('assign_roles_to_Peter', 'AdminToolsController@assign_roles');


    Route::get('resluggify/{itemkind}', 'Starter\AdminToolsController@resluggify');
    Route::get('admin_tool/regenerate_a_slug/{modelname}/{modelid}', 'Starter\AdminToolsPartialsController@regenerate_a_slug');



/////////////////////
// ADMIN WITH NO PREFIX
/////////////////////

Route::group(['middleware' => ['admins','setTheme:uikit']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type



    Route::get('dashboard_users', 'AdminController@dashboard_users');



});



    // user roles
    Route::get('experiments/gravatar', 'StarterController@experiments_gravatar');






Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');





Route::get('set_theme/{themeName}', 'Starter\UserWorkspacesController@set_theme');


/////////////////////
// user settings management
/////////////////////

    // sync_available_settings: create records in user_setting table
    Route::get('user/sync_available_settings/{routineid}', 'Starter\UserWorkspacesController@sync_available_settings');

    Route::get('routine/complete_activity/{routineid}/{activityid}', 'RoutinesController@complete_activity');