<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScenicService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getScenic(Request $request){
        $this->validate($request, [
            'type'=> 'required',
            'length'=> 'required'
        ]);
        $params = $request->all();
        $scenic = new ScenicService();
        if ($params['type'] == 'hot') {
            return $scenic->getHotScenic($params['length']);
        }
        if ($params['type'] == 'price') {
            return $scenic->getHasCustomPrice($params['length']);
        }
        return [];
    }
}
