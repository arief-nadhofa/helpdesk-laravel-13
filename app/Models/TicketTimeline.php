<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTimeline extends Model
{
    public $timestamps = false;
    protected $table = 'ticket_timeline';

    protected $fillable = [
        'ticket_number',
        'status',
        'created_at',
    ];
}
