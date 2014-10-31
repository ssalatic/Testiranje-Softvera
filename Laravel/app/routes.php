<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::bind('users', function($id)
{
	return App\UserModel::whereId($id)-first();
});

Route::bind('competitions', function($id)
{
	return App\CompetitionModel::whereId($id)-first();
});

Route::bind('concerts', function($id)
{
	return App\ConcertModel::whereId($id)-first();
});

Route::bind('coreographys', function($id)
{
	return App\CoreographyModel::whereId($id)-first();
});

Route::bind('Costumes', function($id)
{
	return App\CostumeModel::whereId($id)-first();
});

Route::bind('groups', function($id)
{
	return App\GroupModel::whereId($id)-first();
});

Route::bind('rhythms', function($id)
{
	return App\RhythmModel::whereId($id)-first();
});

Route::bind('tickets', function($id)
{
	return App\TicketModel::whereId($id)-first();
});

Route::bind('trainings', function($id)
{
	return App\TrainingModel::whereId($id)-first();
});



Route::get('/', array( 'before' => 'auth', 'using' => 'PagesController@index'));

Route::resource('competitions', 'CompetitionController');

Route::resource('concerts', 'ConcertController');

Route::resource('coreographys', 'CoreographyController');

Route::resource('costumes', 'CostumeController');

Route::resource('groups', 'GroupController');

Route::resource('rhythms', 'RhythmController');

Route::resource('tickets', 'TicketController');

Route::resource('trainings', 'TrainingController');

Route::resource('users', 'UserController');


Route::get('login', array('before' => 'secure', 'https' => true , 'as' => 'login', 'uses' => 'PagesController@login'));

Route::get('handleLogin', array('before' => 'csrf', 'https' => true , 'as' => 'handle.login', 'uses' => 'PagesController@handleLogin'));

