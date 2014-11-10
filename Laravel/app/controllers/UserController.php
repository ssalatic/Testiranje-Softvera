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
				'password' => 'sometimes|required|alpha_num|min:8',
				'password_agn' => 'sometimes|required|min:8|alpha_num|same:password',
				'user_type' => 'sometimes|digits_between:1,2|required',
				'first_name' => 'sometimes|alpha|max:45',
				'last_name' => 'sometimes|alpha|max:45',
				'birth_date' => 'sometimes|date',
				'social_number' => 'sometimes|digits:13|unique:user,social_number',
				'phone_number' => 'sometimes|numeric|max:45',
				'address' => 'sometimes|alpha_num|max:200',
				'height' => 'sometimes|digits:3',
				'shoe_size' => 'sometimes|digits:2',
				'ballet_shoe_size' => 'sometimes|digits:2',
				'sneakers_size' => 'sometimes|digits:2',
				'changed_by' => 'sometimes|integer|exists:user,id',
				'email' => 'sometimes|email|unique:user,email|required',
				'sex' => 'sometimes|in:male,female',
				'competition_user.result' => 'sometimes|alpha_num|max:45'
				
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
		//
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

		$validator = $this->validate(Input::except(['di']));
		
		if ($validator->passes()) 
		{
			$user = new UserModel;
			
			$user->email = Input::get('email');
			$user->sex = Input::get('gender');
			$user->height = Input::get('height');
			$user->birth_date = Input::get('birthday');
			$user->password = Input::get('password');
			$user->username = Input::get('username');
			$user->validated = Session::token();
			
		    $user->save();
		    
		    Mail::queue('emails.welcome', array('token' => Session::token()), function($message)
		    {
		    	$message->to(Input::get('email'), Input::get('username'))->subject('Welcome!');
		    });
		    
		    return Redirect::route('login')->with('msg', 'Thanks for registering! Validation e-mail was sent to provided address!');
		} 
		else 
		{	
			return Redirect::route('users.create')->withErrors($validator)->withInput();	
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
		//
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
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
