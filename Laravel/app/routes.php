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
//Route::model('competitions', 'CompetitionModel');
/* Route::bind('users', function($id)
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


Route::bind('choreographys', function($id)
{
	return App\ChoreographyModel::whereId($id)-first();
});

Route::bind('costumes', function($id)
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
 */
/*Route::resource('competitions', 'CompetitionController', array('only' => array('index', 'show')));

Route::group(array('prefix' => 'admin'), function()
{
		Route::resource('competitions', 'CompetitionController');
});*/


Route::group(array('before' => 'secure'), function()
{
	Route::get('/', array( 'before' => 'auth', 'as' => 'index', 'uses' => 'PagesController@index'));
	//Route::resource('competitions', 'CompetitionController');
	/*Route::resource('competitions', array('before' => 'secure', 'https' => true, 'as' => 'competitions','uses' => 'CompetitionController@index', function()
	{
		//if(Auth::user()->isAdmin())
			//	return Redirect::to('admin_competitions');
			
	}));*/
	//Route::resource('competitions', 'CompetitionController');
	//Route::resource('competitions', 'CompetitionController', array('only' => array('index', 'show')));

	/*Route::group(array('prefix' => 'admin'), function()
	{*/
		Route::resource('competitions', 'CompetitionController');
	//});
	
	Route::resource('concerts', 'ConcertController');
	
	Route::resource('choreographies', 'ChoreographyController');
	
	Route::resource('costumes', 'CostumeController');
	
	Route::resource('groups', 'GroupController');
	
	Route::resource('rhythms', 'RhythmController');
	
	Route::resource('tickets', 'TicketController');
	
	Route::resource('trainings', 'TrainingController');
	
	Route::resource('users', 'UserController');
	
	Route::get('emptyPage/{id}', array('before' => 'secure|auth', 'https' => true , 'as' => 'emptyPage', 'uses' => 'CostumeController@emptyPage'), function($id){
		return $id;
	}
	);
	
	Route::post('addToKnows', array('before' => 'secure|auth', 'https' => true , 'as' => 'addToKnows', 'uses' => 'ChoreographyController@addToKnows'));
	Route::post('removeFromKnows', array('before' => 'secure|auth', 'https' => true , 'as' => 'removeFromKnows', 'uses' => 'ChoreographyController@removeFromKnows'));
	
	Route::post('addToCanWear', array('before' => 'secure|auth', 'https' => true , 'as' => 'addToCanWear', 'uses' => 'CostumeController@addToCanWear'));
	Route::post('removeFromCanWear', array('before' => 'secure|auth', 'https' => true , 'as' => 'removeFromCanWear', 'uses' => 'CostumeController@removeFromCanWear'));
	
	
	Route::get('login', array('before' => 'secure|isAuth', 'https' => true , 'as' => 'login', 'uses' => 'PagesController@login'));
	Route::get('gallery', array('before' => 'secure|auth', 'https' => true , 'as' => 'gallery', 'uses' => 'PagesController@gallery'));
	Route::get('function', array('before' => 'secure|auth', 'https' => true , 'as' => 'function', 'uses' => 'PagesController@get_user_func'));
	Route::delete('competitions.destroyFile/{id}', array('before' => 'secure|auth', 'https' => true , 'as' => 'competitions.destroyFile', 'uses' => 'CompetitionController@destroyFile'));
	Route::post('competitions.upload/{id}', array('before' => 'secure|auth', 'https' => true , 'as' => 'competitions.upload', 'uses' => 'CompetitionController@upload'));

	Route::put('password.new/{id}', array('https' => true , 'as' => 'password.new', 'uses' => 'UserController@new_password'));

	Route::put('update.dues/{id}', array('https' => true , 'as' => 'update.dues', 'uses' => 'UserController@update_dues'));
	
	Route::get('logout', array('as' => 'logout', 'uses' => 'PagesController@logout'));
	
	Route::post('handleLogin', array('before' => 'csrf', 'https' => true , 'as' => 'handle.login', 'uses' => 'PagesController@handleLogin'));

	Route::post('costumetype_add', array('https' => true , 'as' => 'add.costumetype', 'uses' => 'CostumeController@add_costume_type'));

	Route::post('costume_add', array('https' => true , 'as' => 'add.costume', 'uses' => 'CostumeController@add_costume'));

	Route::get('validate', array('as' => 'validate', function()
	{
		$token = Input::get('token');
		
		$user = UserModel::where('validated', '=', $token)->firstOrFail();
		
		$user->user_type = 3;
		$user->validated = null;
		$user->save();
		
		return Redirect::to('login')->with('msg', 'Your account is now validated!');
	}));
	
	

// admin routes
	
	/*Route::get('admin/competitions', array('before' => 'admin', 'as' => 'admin-competitions', function()
	{
		return Redirect::to('admin_competitions');
	}));*/
});


