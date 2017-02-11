<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use App\Models\Ticket;

class TicketController extends Controller
{
    function index($id)
    {
        $scenic = Scenic::with('ticket')->find($id);
        if (!$scenic) {
            return redirect('/user/scenic');
        }
        return view('user.ticket')->with('scenic', $scenic->toArray());
    }

    function add($id)
    {
        $scenic = Scenic::find($id);
        if (!$scenic) {
            return redirect('user/scenic');
        }
        return view('user.ticket-add')->with('scenic', $scenic->toArray());
    }

    function update($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $scenic = Scenic::where(['id' => $ticket->scenic_id, 'user_id' => Auth::id()])->first();
            if ($scenic) {
                $scenic = $scenic->toArray();
                $scenic['ticket'] = $ticket->toArray();
                return view('user.ticket-add')->with('scenic', $scenic);
            }
        }
        return redirect('/user/scenic');
    }

    function updateTicket($id, Request $request)
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
        $ticket = Ticket::where(['id' => $id, 'scenic_id' => $input['scenic_id']])->first();
        if ($ticket) {
            foreach ($input['custom_price'] as $key => $value) {
                if ($value && ($input['start_time'][$key] || $input['end_time'][$key])) {
                    $data['custom_price'][] = [
                        'start_time' => $input['start_time'][$key] ? strtotime($input['start_time'][$key]) : strtotime($input['end_time'][$key]),
                        'end_time' => $input['end_time'][$key] ? strtotime($input['end_time'][$key] . '+1 day') : strtotime($input['start_time'][$key] . '+1 day'),
                        'price' => $value
                    ];
                }
            }
            $input['custom_price'] = isset($data) ? $data['custom_price'] : [];
            $ticket->name = $input['name'];
            $ticket->price = $input['price'];
            $ticket->custom_price = $input['custom_price'];
            $ticket->valid_time = $input['valid_time'];
            $ticket->lead_time = $input['lead_time'];
            $ticket->last_time = $input['last_time'];
            $ticket->save();
        }
        return redirect('user/scenic/' . $input['scenic_id']);
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
        foreach ($input['custom_price'] as $key => $value) {
            if ($value && ($input['start_time'][$key] || $input['end_time'][$key])) {
                $data['custom_price'][] = [
                    'start_time' => $input['start_time'][$key] ? strtotime($input['start_time'][$key]) : strtotime($input['end_time'][$key]),
                    'end_time' => $input['end_time'][$key] ? strtotime($input['end_time'][$key] . '+1 day') : strtotime($input['start_time'][$key] . '+1 day'),
                    'price' => $value
                ];
            }
        }
        $input['custom_price'] = isset($data) ? $data['custom_price'] : [];
        Ticket::create($input);
        return redirect('user/scenic');
    }

    function deleteTicket($id){
        Ticket::with(['scenic'=> function($query){
            $query->where('user_id', Auth::id());
        }])->where('id', $id)->delete();
        return redirect()->back();
    }

}