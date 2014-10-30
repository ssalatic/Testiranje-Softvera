<?php

class PagesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}
	
	public function login()
	{
		return View::make('login');
	}
	
	public function handleLogin()
	{
		return 'Some magic!!! :)';
	}

}
