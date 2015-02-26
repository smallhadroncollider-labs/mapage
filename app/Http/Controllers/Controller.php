<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Contracts\Auth\Guard;

use View;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public function __construct(Guard $auth) {
        View::share("user", $auth->user() ? : false);
    }
}
