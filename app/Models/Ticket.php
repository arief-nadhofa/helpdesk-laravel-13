<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // Tambahkan baris ini untuk mematikan timestamps otomatis
    public $timestamps = false;
    protected $table = 'tickets';

    protected $fillable = [
        'ticket_number',
        'date',
        'category_id',
        'user_request',
        'problem_description',
        'status',
        'created_at'
    ];
}
