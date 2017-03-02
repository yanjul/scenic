<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model {
    protected $table = 'order_info';

    protected $fillable = [
        'sn',
        'user_id',
        'scenic_id',
        'scenic_name',
        'tourist_name',
        'mobile',
        'distributor_id',
        'distributor_name',
        'pay_price',
        'paid_price',
        'pay_status',
        'order_type',
        'order_status',
        'play_time',
        'admission_time',
        'audit_user_id',
        'audit_user_name',
        'remark',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function detail() {
        return $this->hasMany('App\Models\OrderDetails', 'order_id', 'id');
    }

    public function payment() {
        return $this->hasOne('App\Models\OrderPaymentDetails', 'order_id', 'id');
    }

    public function scenic() {
        return $this->belongsTo('App\Models\Scenic', 'scenic_id', 'id');
    }
}
