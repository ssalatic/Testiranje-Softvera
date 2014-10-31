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
        return View::make('pages.login');
    }

    public function handleLogin()
    {
        return 'Some magic!!! :)';
    }

}