<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributionDetails extends Model
{
    protected $table = 'scenic_distribution_details';

    protected $fillable = [
        'distribution_id',
        'ticket_id',
        'ticket_name',
        'ticket_price',
        'ticket_number'
    ];

    public function distribution()
    {
        return $this->belongsTo('App\Models\distribution', 'distribution_id', 'id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }
}
