
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

