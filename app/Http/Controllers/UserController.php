<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;

class UserController extends Controller {
    public function __construct(Guard $auth) {
        parent::__construct($auth);
        $this->auth = $auth;
    }

    public function current() {
        return $this->auth->user() ? : abort(401);
    }

    public function signup() {
        return view("user/signup");
    }

    public function signupRequest(SignupRequest $request) {
        $user = new User($request->only(["name", "email"]));
        $user->password = bcrypt($request->input("password"));
        $user->save();

        $this->auth->attempt($request->only(["email", "password"]), true);

        return redirect("/");
    }

    public function login() {
        return view("user/login");
    }

    public function loginRequest(LoginRequest $request) {
        $this->auth->attempt($request->only(["email", "password"]), true);
        return redirect("/");
    }

    public function logout() {
        $this->auth->logout();
        return redirect("/");
    }
}
