<?php

namespace App\Http\Controllers;

use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\Scenic;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {

    function create(Request $request){
        $this->validate($request, [
            'scenic_id'=> 'required',
            'ticket_id'=> 'required|array',
            'ticket_number'=> 'required|array',
        ]);
        $data = $request->input();
        $orderService = new OrderService();
        $order_data = $orderService->getInitOrderData($data);

        try{
            DB::beginTransaction();
            $orderInfo = OrderInfo::create($order_data['info']);
            foreach ($order_data['detail'] as $value) {
                OrderDetails::create(array_merge($value, ['order_id'=> $orderInfo->id]));
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }



    }

}