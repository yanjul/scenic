<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentDetails extends Model {
    protected $table = 'order_payment_details';

    protected $fillable = [
        'order_id',
        'order_sn',
        'pay_type',
        'pay_mode',
        'pay_account',
        'pay_at',
        'pay_price',
        'remark'
    ];


}
