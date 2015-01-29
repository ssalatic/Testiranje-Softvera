<?php

class UserController extends \BaseController {
	
	private $user;
	
	public function __construct(UserModel $usr)
	{
		$this->user = $usr;
		
		$this->beforeFilter('auth', [
					
				'only' => ['edit']
		
		]);
		
		$this->beforeFilter('csrf', [
					
				'only' => ['store']
		
		]);
		
		$this->beforeFilter('auth|csrf', [
					
				'only' => ['update', 'delete']
		
		]);
		
		$this->beforeFilter('auth', [
					
				'except' => ['create', 'store', 'update', 'delete', 'edit']
		
		]);
	}
	
	
	public function validate($data)
	{

		$rules = array(
				
				'id' =>'sometimes|required|integer|unique:user,id',
				'username' => 'sometimes|required|alpha_num|between:6,45|unique:user,username',
				//'password' => 'sometimes|required|alpha_num|min:8',
				//'password_agn' => 'sometimes|required|min:8|alpha_num|same:password',
				'user_type' => 'sometimes|digits_between:0,3|required',
				'first_name' => 'sometimes|alpha|max:45',
				'last_name' => 'sometimes|alpha|max:45',
				'birth_date' => 'sometimes|date',
				'social_number' => 'sometimes|digits:13|unique:user,social_number',
				'phone_number' => 'sometimes|max:45',
				//'address' => 'sometimes|alpha_num|max:200',
				'height' => 'sometimes|digits:3',
				'shoe_size' => 'sometimes|digits:2',
				'ballet_shoe_size' => 'sometimes|digits:2',
				'sneakers_size' => 'sometimes|digits:2',
				//'changed_by' => 'sometimes|integer|exists:user,id',
				'email' => 'sometimes|email|unique:user,email|required',
				'sex' => 'sometimes|in:male,female',
				//'competition_user.result' => 'sometimes|alpha_num|max:45'
				
		);
		
		return Validator::make($data, $rules);
		
	}
	
	
	public function authorized()
	{
		if (Auth::user()->userType >= 10 && Auth::user()->id != Input::get('id'))
			return false;
		
		return true;
	}

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::route('users.show', Auth::user()->id);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.register', array('msg' => Session::get('msg')));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
		{

		$validator = $this->validate(Input::except(['id']));
		
		if ($validator->passes())
		{
			$user = new UserModel();

			$user->username = Input::get('username');
			$user->password = Input::get('password');	
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->birth_date = Input::get('birth_date');
			$user->phone_number = Input::get('phone_number');
			$user->email = Input::get('email');
			$user->sex = Input::get('gender');
			
			
			$dencer = Input::get('dancer');
			$designer = Input::get('designer');
			$trainer = Input::get('trainer');
			$admin = Input::get('admin');

			if($dencer == 'on' && $designer == 'on' && $trainer == 'on' && $admin == 'on') $user->user_type = 14;
			else if($admin == 'on' && $trainer == 'on' && $designer == 'on') $user->user_type = 10;
			else if($admin == 'on' && $trainer == 'on' && $dencer == 'on') $user->user_type = 11;
			else if($admin == 'on' && $designer == 'on' && $dencer == 'on') $user->user_type = 12;
			else if($trainer == 'on' && $designer == 'on' && $dencer == 'on') $user->user_type = 13;

			else if($admin == 'on' && $trainer == 'on') $user->user_type = 4;
			else if($admin == 'on' && $designer == 'on') $user->user_type = 5;
			else if($admin == 'on' && $dencer == 'on') $user->user_type = 6;
			else if($trainer == 'on' && $designer == 'on') $user->user_type = 7;
			else if($trainer == 'on' && $dencer == 'on') $user->user_type = 8;
			else if($designer == 'on' && $dencer == 'on') $user->user_type = 9;

			else if($admin == 'on') $user->user_type = 0;
			else if($trainer == 'on') $user->user_type = 1;
			else if($designer == 'on') $user->user_type = 2;
			else if($dencer == 'on') $user->user_type = 3;

			//echo $user->user_type;
			//$user->user_type = Input::get('user_type');


			$user->height = Input::get('height');
			$user->shoe_size = Input::get('shoe_size');
			$user->sneakers_size = Input::get('sneakers_size');
			$user->ballet_shoe_size = Input::get('ballet_shoe_size');
			$user->validated = Session::token();

		    $user->save();
			$user->groups()->attach(Input::get('groups'));

			
		    Mail::queue('emails.welcome', array('token' => Session::token()), function($message)
		    {
		    	$message->to(Input::get('email'), Input::get('username'))->subject('Welcome!');
		    });/*
			return Redirect::route('users.update',$user->id)->with('msg', 'Thanks for registering! Validation e-mail was sent to provided address!');
		    */

			//return Redirect::back()->with('msg', 'Radiiiii!');
			//return Redirect::route('users.show',Auth::user()->id)->withErrors($validator)->withInput();
		     return Redirect::back()->withErrors(['Thanks for registering! Validation e-mail was sent to provided address!']);
			 //return Redirect::route('practices.update')->with('msg', 'Thanks for registering! Validation e-mail was sent to provided address!');
		}
		else
		{	
			//return Redirect::route('users.show',Auth::user()->id)->withErrors(['Ne valja']);
			return Redirect::route('users.show',Auth::user()->id)->withErrors($validator)->withInput();
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = UserModel::find($id);
		if (Auth::user()->isAdmin())
			return View::make('pages.admin_profile', array('user' => $user));
		else if(Auth::user()->isTrainer())
			return View::make('pages.trainer_profile', array('user' => $user));
		else
			return View::make('pages.profile', array('user' => $user));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = UserModel::find($id);
		
		$validator = $this->validate(Input::except(['id','username']));
		
		if ($validator->passes()) 
		{

			$user->username = Input::get('username');
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->birth_date = Input::get('birth_date');
			$user->phone_number = Input::get('phone_number');
			$user->email = Input::get('email');
			$user->sex = Input::get('gender');

			$dencer = Input::get('dancer');
			$designer = Input::get('designer');
			$trainer = Input::get('trainer');
			$admin = Input::get('admin');

			if($dencer == 'on' && $designer == 'on' && $trainer == 'on' && $admin == 'on') $user->user_type = 14;
			else if($admin == 'on' && $trainer == 'on' && $designer == 'on') $user->user_type = 10;
			else if($admin == 'on' && $trainer == 'on' && $dencer == 'on') $user->user_type = 11;
			else if($admin == 'on' && $designer == 'on' && $dencer == 'on') $user->user_type = 12;
			else if($trainer == 'on' && $designer == 'on' && $dencer == 'on') $user->user_type = 13;

			else if($admin == 'on' && $trainer == 'on') $user->user_type = 4;
			else if($admin == 'on' && $designer == 'on') $user->user_type = 5;
			else if($admin == 'on' && $dencer == 'on') $user->user_type = 6;
			else if($trainer == 'on' && $designer == 'on') $user->user_type = 7;
			else if($trainer == 'on' && $dencer == 'on') $user->user_type = 8;
			else if($designer == 'on' && $dencer == 'on') $user->user_type = 9;

			else if($admin == 'on') $user->user_type = 0;
			else if($trainer == 'on') $user->user_type = 1;
			else if($designer == 'on') $user->user_type = 2;
			else if($dencer == 'on') $user->user_type = 3;

			$user->height = Input::get('height');
			$user->shoe_size = Input::get('shoe_size');
			$user->sneakers_size = Input::get('sneakers_size');
			$user->ballet_shoe_size = Input::get('ballet_shoe_size');

			$user->groups()->detach();
			$user->groups()->attach(Input::get('groups'));

			$user->save();
			//$usr->groups()->sync(Input::get('groups'));
			return Redirect::route('users.show', $user->id)->withErrors("Updated");
		}
		else
		{
			return Redirect::route('users.show', $user->id)->withErrors($validator);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		UserModel::find($id)->delete();
		
		return Redirect::route('users.show', Auth::user()->id);
	}



	public function new_password($id){
		$usr = UserModel::find($id);

		$rules = array(
			'new_password' => 'required|alpha_num|min:8',
		);

		$validator = Validator::make(Input::all(['new_password']), $rules);

		if ($validator->passes()) {
			if (Hash::check(Input::get('old_password'), $usr->password)) {
				$usr->password = Input::get('new_password');
				$usr->save();
				return Redirect::route('users.show', $usr->id)->withErrors(['Changed']);
			} else
				return Redirect::route('users.show', $usr->id)->withErrors(['Does not match']);
		}else{
			return Redirect::route('users.show', $usr->id)->withErrors($validator)->withInput();
		}
	}


	public function update_dues($id){
		$dues = PaymentModel::firstOrCreate(array('user_id' => $id));
		$dues->user_id = $id;
		$dues->date_payed = Input::get('date');
		$dues->amount = Input::get('amount');

		$dues->save();
		return Redirect::route('users.show', $id)->withErrors(['Changed']);
	}


}
