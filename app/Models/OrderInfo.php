<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model {
    protected $table = 'order_payment_details';

    protected $fillable = [
        'sn',
        'tourist_id',
        'tourist_name',
        'mobile',
        'distributor_id',
        'distributor_name',
        'pay_price',
        'paid_price',
        'pay_status',
        'order_status',
        'play_time',
        'admission_time',
        'audit_user_id',
        'audit_user_name',
        'remark',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users', 'id', 'tourist_id');
    }

    public function detail() {
        return $this->hasOne('App\Models\OrderDetails', 'order_id', 'id');
    }

    public function payment() {
        return $this->hasOne('App\Models\OrderPaymentDetails', 'order_id', 'id');
    }
}
