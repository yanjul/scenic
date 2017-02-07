<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function index() {
        return view('user.main');
    }
}