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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('leagues/request/{id}', 'LeagueController@request');
Route::get('leagues/requests', 'LeagueController@viewRequests');
Route::post('leagues/acceptRequest', 'LeagueController@acceptRequest');
Route::post('leagues/request', 'LeagueController@storeRequest');
Route::resource('leagues', 'LeagueController');

Route::get('messagehome', 'UserController@messageHome');


Route::get('teams/request/{id}', 'TeamController@request');
Route::get('teams/requests', 'TeamController@viewRequests');
Route::post('teams/acceptRequest', 'TeamController@acceptRequest');
Route::post('teams/request', 'TeamController@storeRequest');

Route::resource('teams', 'TeamController');

Route::get('messagecreate', 'UserController@messageCreate');

Route::post('messagestore', 'UserController@messageStore');

Route::get('show/{id}', 'UserController@show');


Route::get('conversation/{username}', 'UserController@conversation');

Route::post('messageupdate','UserController@messageUpdate');

Route::get('leagues/{id}/schedule', 'GameController@schedule');
Route::get('leagues/{id}/games', 'GameController@index');
Route::get('leagues/{leagueid}/games/{gameid}/declarewinner', 'GameController@declarewinner');
Route::get('leagues/{leagueid}/games/{gameid}', 'GameController@show');
Route::post('storegame', 'GameController@store');
Route::post('storeresults', 'GameController@storeResults');

Route::get('leagues/{leagueid}/games/{gameid}/statform', 'StatController@statForm');

Route::get('messagesend/{username}','UserController@messageSend');

Route::post('messagestoredirect','UserController@messageStoreDirect');
