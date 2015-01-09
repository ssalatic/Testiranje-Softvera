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
				'phone_number' => 'sometimes|alpha|max:45',
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
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->birth_date = Input::get('birth_date');
			$user->social_number = Input::get('social_number');
			$user->phone_number = Input::get('phone_number');
			$user->email = Input::get('email');
			$user->sex = Input::get('gender');
			$user->user_type = Input::get('user_type');
			$user->height = Input::get('height');
			$user->password = Input::get('social_number');
			$user->shoe_size = Input::get('shoe_size');
			$user->sneakers_size = Input::get('sneakers_size');
			$user->ballet_shoe_size = Input::get('ballet_shoe_size');
			$user->validated = Session::token();
			
		    $user->save();
		    
		    Mail::queue('emails.welcome', array('token' => Session::token()), function($message)
		    {
		    	$message->to(Input::get('email'), Input::get('username'))->subject('Welcome!');
		    });/*
			return Redirect::route('users.update',$user->id)->with('msg', 'Thanks for registering! Validation e-mail was sent to provided address!');
		    */
			
			//return Redirect::back()->with('msg', 'Radiiiii!');
			return Redirect::route('users.show',Auth::user()->id)->withErrors($validator)->withInput();
		     //return Redirect::back()->withErrors(['Thanks for registering! Validation e-mail was sent to provided address!']);
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
		$usr = UserModel::find($id);
		
		$validator = $this->validate(Input::except(['id','username']));
		
		if ($validator->passes()) 
		{
			
			$usr->username = Input::get('username');
			$usr->first_name = Input::get('first_name');
			$usr->last_name = Input::get('last_name');
			$usr->birth_date = Input::get('birth_date');
			$usr->social_number = Input::get('social_number');
			$usr->phone_number = Input::get('phone_number');
			$usr->email = Input::get('email');
			$usr->sex = Input::get('gender');
			$usr->user_type = Input::get('user_type');
			$usr->height = Input::get('height');
			$usr->shoe_size = Input::get('shoe_size');
			$usr->sneakers_size = Input::get('sneakers_size');
			$usr->ballet_shoe_size = Input::get('ballet_shoe_size');
			
		    $usr->save();
			//$usr->groups()->sync(Input::get('groups'));
			return Redirect::route('users.show', $usr->id)->withErrors("Updated");
		}
		else
		{
			return Redirect::route('users.show', $usr->id)->withErrors($validator);
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


}
