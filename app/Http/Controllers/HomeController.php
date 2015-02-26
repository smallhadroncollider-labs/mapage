<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;

class HomeController extends Controller {
    public function __construct(Guard $auth) {
        parent::__construct($auth);
        $this->auth = $auth;
    }

	public function index()
	{
		return view('home');
	}
}
