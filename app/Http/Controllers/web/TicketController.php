<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use App\Models\Ticket;

class TicketController extends Controller
{
    function add($id)
    {
        $scenic = Scenic::find($id);
        if (!$scenic) {
            return redirect('user/scenic');
        }
        return view('user.ticket-add')->with('scenic', $scenic);
    }

    function createTicket(Request $request)
    {
        $this->validate($request, [
            'scenic_id' => 'required',
            'name' => 'required|max:18',
            'price' => 'required',
            'start_time' => 'array',
            'end_time' => 'array',
            'custom_price' => 'array',
            'valid_time' => '',
            'lead_time' => '',
            'last_time' => ''
        ]);
        $input = $request->input();
        $data = array();
        foreach ($input['custom_price'] as $key => $value) {
            if ($value && ($input['start_time'][$key] || $input['end_time'][$key])) {
                $start_time = $input['start_time'][$key] ? strtotime($input['start_time'][$key]) : strtotime($input['end_time'][$key]);
                $end_time = $input['end_time'][$key] ? strtotime($input['end_time'][$key] . '+1 day') : strtotime($input['start_time'][$key] . '+1 day');
                $data['custom_price'][] = [
                    'time' => $start_time . '-' . $end_time,
                    'price' => $value
                ];
            }
        }
        print_r($data);
    }

}