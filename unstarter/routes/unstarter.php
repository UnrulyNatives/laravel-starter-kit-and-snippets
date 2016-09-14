<?php

/////////////////////
// UNRULYNATIVES LARAVEL STARTER KIT
/////////////////////

// comment this route to make the `/` route in 'web.php' be first to read
Route::get('/', 'UNStarter\StarterController@landing');

// referred to in help.md
Route::get('unrulyhelpers', 'UNStarter\StarterController@landing');


// example - using functions in routes file
// Route::get('/', function () {
//     return view('starter.landing');
// });



// manual login: return to initial location, using username and/or email
Route::get('login2', 'UNStarter\Auth\AuthController@login2');
Route::post('login2', 'UNStarter\Auth\AuthController@authenticate');

Route::get('logout', 'Auth\LoginController@logout');



Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');




/////////////////////
// STARTER
/////////////////////
// This group would prevend interference of the UN Laravel Starter routes with your own routes
Route::group(['prefix' => 'unstarter','middleware' => ['setTheme:bootstrap']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

    Route::get('/', 'UNStarter\StarterController@landing');
    Route::get('landing', 'UNStarter\StarterController@landing');

    Route::get('frontend', function () {
        return view('unstarter.frontend.components_common');
    });
    Route::get('initial-setup', 'UNStarter\StarterController@initial_setup');
    Route::get('features', 'UNStarter\StarterController@features');
    Route::get('packages', 'UNStarter\StarterController@packages');
    Route::get('contributors', 'UNStarter\StarterController@contributors');
    Route::get('minitools', 'UNStarter\StarterController@minitools');
    Route::get('snippets', 'UNStarter\StarterController@snippets');
    Route::get('admintools', 'UNStarter\AdminToolsController@dashboard_admintools');


    Route::get('admintools/remove-status-null/{itemkind?}', 'UNStarter\AdminToolsController@remove_status_null');

    Route::get('admintools/user-track/{user?}', 'UNStarter\AdminToolsController@user_track');


    Route::get('admintools/assign-roles/{user?}/{role?}', 'UNStarter\AdminToolsController@assign_roles');

    Route::get('admintools/regenerate-model-name/{modelname?}', 'UNStarter\AdminToolsController@regenerate_model_name');




    //package Resources
    /********************* package ***********************************************/
    Route::resource('package','\App\Http\Controllers\UNStarter\PackageController');
    Route::post('package/{id}/update','\App\Http\Controllers\UNStarter\PackageController@update');
    Route::get('package/{id}/delete','\App\Http\Controllers\UNStarter\PackageController@destroy');
    Route::get('package/{id}/deleteMsg','\App\Http\Controllers\UNStarter\PackageController@DeleteMsg');
    /********************* package ***********************************************/


    //feature Resources
    /********************* feature ***********************************************/
    Route::get('feature/create','\App\Http\Controllers\UNStarter\FeatureController@create');

    Route::resource('feature','\App\Http\Controllers\UNStarter\FeatureController');
    Route::post('feature/{id}/update','\App\Http\Controllers\UNStarter\FeatureController@update');
    Route::get('feature/{id}/delete','\App\Http\Controllers\UNStarter\FeatureController@destroy');
    Route::get('feature/{id}/deleteMsg','\App\Http\Controllers\UNStarter\FeatureController@DeleteMsg');
    /********************* feature ***********************************************/



});


//user_setting Resources
/********************* user_setting ***********************************************/
Route::resource('user_setting','\App\Http\Controllers\UNStarter\User_settingController');
Route::post('user_setting/{id}/update','\App\Http\Controllers\UNStarter\User_settingController@update');
Route::get('user_setting/{id}/delete','\App\Http\Controllers\UNStarter\User_settingController@destroy');
Route::get('user_setting/{id}/deleteMsg','\App\Http\Controllers\UNStarter\User_settingController@DeleteMsg');
/********************* user_setting ***********************************************/


//setting Resources
/********************* setting ***********************************************/
Route::resource('setting','\App\Http\Controllers\UNStarter\SettingController');
Route::post('setting/{id}/update','\App\Http\Controllers\UNStarter\SettingController@update');
Route::get('setting/{id}/delete','\App\Http\Controllers\UNStarter\SettingController@destroy');
Route::get('setting/{id}/deleteMsg','\App\Http\Controllers\UNStarter\SettingController@DeleteMsg');
/********************* setting ***********************************************/


/////////////////////
// ADMIN WITH PREFIX
/////////////////////

Route::group(['prefix' => 'unstarter/admin','middleware' => ['setTheme:semantic']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type

        Route::get('/', 'UNStarter\AdminController@index');
        Route::get('dashboard-admintools', 'UNStarter/AdminToolsController@index');

        Route::get('server-status', 'UNStarter\AdminToolsController@server_status');


        Route::get('dashboard-alerts', 'UNStarter/AdminToolsController@dashboard_alerts');
        Route::get('dashboard-volunteers-caretakers', 'AdminToolsController@dashboard_volunteers_caretakers');
        Route::get('dashboard-caretaker', 'UserWorkspacesController@dashboard_caretaker');


});



/////////////////////
// ADMIN WITH NO PREFIX
/////////////////////

Route::group(['middleware' => ['admins','setTheme:semantic']], function()
{
    // http://laravel.io/forum/02-17-2015-laravel-5-routes-restricting-based-on-user-type



    Route::get('dashboard_users', 'UNStarter\AdminController@dashboard_users');



});

    Route::get('user-track/{userid}', 'UNStarter\AdminToolsController@user_track');

    // user roles
    Route::get('assign_roles_to_Peter', 'UNStarter\AdminToolsController@assign_roles');


    Route::get('resluggify/{itemkind}', 'UNStarter\AdminToolsController@resluggify');
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
    Route::get('experiments/gravatar', 'UNStarter/StarterController@experiments_gravatar');







Route::get('set_theme/{themeName}', 'UNStarter\UserWorkspacesController@set_theme');


/////////////////////
// user settings management
/////////////////////

    // sync_available_settings: create records in user_setting table
    Route::get('user/sync_available_settings/{routineid}', 'UNStarterController\UserWorkspacesController@sync_available_settings');

    Route::get('routine/complete_activity/{routineid}/{activityid}', 'RoutinesController@complete_activity');





/////////////////////
// MODERATOR TOOLS
/////////////////////

        // in index views - changes status to new val, e. 1, 6
    Route::get('moderator_tool/switch/{itemkind}/{field}/{id}/{newval?}', 'UNStarter\ModeratorToolsPartialsController@change_field_value');
