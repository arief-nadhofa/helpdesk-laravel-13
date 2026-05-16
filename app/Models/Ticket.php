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
        'note',
        'created_at'
    ];

    public function account()
    {
        // Ticket belongs to Account
        return $this->belongsTo(Account::class, 'user_request', 'id_number');
    }

    public function category()
    {
        // Ticket belongs to Account
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function status()
    {
        // Ticket belongs to Account
        return $this->belongsTo(Status::class, 'status', 'id');
    }
}
