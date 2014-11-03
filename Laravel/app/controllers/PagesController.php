<?php

class PagesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('index');
    }

    public function login()
    {
        return View::make('pages.login', array('msg' => Session::get('msg')));
    }
    
    public function logout()
    {
    	Auth::logout();
    	
    	return Redirect::to('login')->with('msg', 'Your are now logged out!');
    }

    public function handleLogin()
    {
    	
    	$rules = array(
    	
    			'password' => 'required|alpha_num|min:8',
    			'email' => 'email|exists:user,email|required',
    	
    	);
    	
    	$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->passes()) 
		{
			$remember = Input::get('remember_me') === 'yes';
			if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')), $remember)) 
			{
				if (is_null(Auth::user()->validated))
				{
					return Redirect::route('index');
				}
				else
				{
					Auth::logout();
					return Redirect::route('login')
					->with('msg', 'Your account is not validated!')
					->withInput();
				}
			} 
			else 
			{
				return Redirect::route('login')
				->with('msg', 'Your username/password combination was incorrect')
				->withInput();
			}
		} 
		else 
		{	
			return Redirect::route('login')->withErrors($validator)->withInput();	
		}
    }

}