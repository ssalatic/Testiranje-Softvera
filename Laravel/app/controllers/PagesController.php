<?php

class PagesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {    	
    	Paginator::setPageName('page_a');
    	$pract = UserModel::find(Auth::user()->id)->trainings()->where('date', '>=', date("Y-m-d H:i:s"))->paginate(10);
		
    	Paginator::setPageName('page_b');
    	$comp = UserModel::find(Auth::user()->id)->competitions()->where('date', '>=', date("Y-m-d H:i:s"))->paginate(10);

    	Paginator::setPageName('page_c');
    	$conc = UserModel::find(Auth::user()->id)->concertChoreographyUser()->paginate(10);
    	
        return View::make('index', array('practices' => $pract,
        								 'competitions' => $comp,
        								 'concerts' => $conc,
        								 'groups' => UserModel::find(Auth::user()->id)->groups
         ));
        
    }
    
    public function gallery()
    {
    	return View::make('pages.gallery');
    }

    public function login()
    {
        return View::make('pages.login', array('msg' => Session::get('msg')));
    }
    
    public function logout()
    {
    	Auth::logout();
    	
		return Redirect::to('competitions');
    	return Redirect::to('login')->with('msg', 'Your are now logged out!');
    }

    public function handleLogin()
    {
    	
    	$rules = array(
    	
    			'password' => 'required|alpha_num|min:8',
    			'username' => 'alpha_num|exists:user,username|required',
    	
    	);
    	
    	$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->passes()) 
		{
			$remember = Input::get('remember_me') === 'yes';
			if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), $remember)) 
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
