<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ScenicController extends Controller {

    public function add(){
        return view('user.scenic');
    }

    public function add_data(Request $request){
        var_dump($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            print_r($file);
        }
    }
}