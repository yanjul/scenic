<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use App\Models\Ticket;
use App\Services\TicketService;

class TicketController extends Controller
{
    /**获取景区门票
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function index($id)
    {
        $scenic = Scenic::with('ticket')->find($id);
        if (!$scenic) {
            return redirect('/user/scenic');
        }
        return view('user.ticket')->with('scenic', $scenic->toArray());
    }

    public function getScenic(Request $request) {
        $data = $request->all();
        $query = Ticket::query();
        if (array_key_exists('scenic', $data) && $data['scenic']) {
            $query->with('scenic');
        }
        if (array_key_exists('id', $data) && $data['id']) {
            return $query->find($data['id']);
        }
        if (array_key_exists('scenic_id', $data) && $data['scenic_id']) {
            return $query->where('scenic_id', $data['scenic_id'])->get();
        }
        return [];
    }

    /**创建门票
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function add($id)
    {
        $scenic = Scenic::find($id);
        if (!$scenic) {
            return redirect('user/scenic');
        }
        return view('user.ticket-add')->with('scenic', $scenic->toArray());
    }

    /**获取修改门票
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**修改门票
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function updateTicket($id, Request $request)
    {
        $this->validate($request, [
            'scenic_id' => 'required',
            'name' => 'required|max:18',
            'price' => 'required|between:0,999999999',
            'start_time' => 'array',
            'end_time' => 'array',
            'custom_price' => 'array',
            'valid_time' => 'required|between:1,60',
            'lead_time' => 'required|between:1,5',
            'last_time' => 'required|between:0,24'
        ]);
        $input = $request->input();
        $ticket = Ticket::where(['id' => $id, 'scenic_id' => $input['scenic_id']])->first();
        if ($ticket) {
            print_r($input);
            foreach ($input['custom_price'] as $key => $value) {
                if ($value && ($input['start_time'][$key] || $input['end_time'][$key])) {
                    $data['custom_price'][] = [
                        'start_time' => $input['start_time'][$key] ? strtotime($input['start_time'][$key]) : strtotime($input['end_time'][$key]),
                        'end_time' => $input['end_time'][$key] ? strtotime($input['end_time'][$key] . '+1 day') : strtotime($input['start_time'][$key] . '+1 days'),
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
            $ticket->remark = $input['remark'];
            $ticket->save();
        }
        return redirect('user/scenic/' . $input['scenic_id']);
    }

    /**创建门票
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function createTicket(Request $request)
    {
        $this->validate($request, [
            'scenic_id' => 'required',
            'name' => 'required|max:18',
            'price' => 'required|between:0,999999999',
            'start_time' => 'array',
            'end_time' => 'array',
            'custom_price' => 'array',
            'valid_time' => 'required|between:1,60',
            'lead_time' => 'required|between:1,5',
            'last_time' => 'required|between:0,24'
        ]);
        $input = $request->input();
        $scenic = Scenic::find($input['scenic_id']);
        if ($scenic) {
            $input['scenic_name'] = $scenic->name;
            foreach ($input['custom_price'] as $key => $value) {
                if ($value && ($input['start_time'][$key] || $input['end_time'][$key])) {
                    $data['custom_price'][] = [
                        'start_time' => $input['start_time'][$key] ? strtotime($input['start_time'][$key]) : strtotime($input['end_time'][$key]),
                        'end_time' => $input['end_time'][$key] ? strtotime($input['end_time'][$key] . '+1 day') : strtotime($input['start_time'][$key] . '+1 days'),
                        'price' => $value
                    ];
                }
            }
            $input['custom_price'] = isset($data) ? $data['custom_price'] : [];
            Ticket::create($input);
            return redirect('user/scenic');
        }
        return redirect()->back();
    }

    /**删除门票
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function deleteTicket($id)
    {
        Ticket::with(['scenic' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->where('id', $id)->delete();
        return redirect()->back();
    }

    /**
     * 上架下架
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request){
        $this->validate($request, [
            'id'=> 'required',
            'status'=> 'required'
        ]);
        $data = $request->input();
        $ticket = Ticket::find($data['id']);
        if($ticket && $ticket->status != 2) {
            Ticket::where('id', $data['id'])->update(['status'=> $data['status']]);
        }
        return redirect()->back();
    }

}