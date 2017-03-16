<?php

namespace App\Http\Controllers;

use App\Models\Scenic;
use Illuminate\Http\Request;
use App\Services\ScenicService;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getScenic(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'length' => 'required'
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

    public function ScenicDetail($id)
    {
        $scenic = Scenic::query();
        if (Auth::check()) {
            $scenic->where('user_id', '!=', Auth::id());
        }
        $scenic = $scenic->with(['ticket' => function ($query) {
            $query->where('status', 1);
        }])->find($id);
        if ($scenic) {
            $ticket = new TicketService();
            foreach ($scenic->ticket as $key => $value) {
                $scenic->ticket[$key]->now_price = $ticket->getPrice($value);
            }
            Session::put('old_url', Url::current());
            return view('detail')->with('scenic', $scenic);
        }
        return redirect()->back();
    }
}
