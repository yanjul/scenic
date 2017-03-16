<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $table = 'scenic_distribution';

    protected $fillable = [
        'user_id',
        'scenic_id',
        'scenic_name',
    ];

    public function scenic()
    {
        return $this->belongsTo('App\Models\Scenic', 'scenic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany('App\Models\DistributionDetails', 'distribution_id', 'id');
    }
}
