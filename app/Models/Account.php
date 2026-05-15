<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    // Tambahkan baris ini untuk mematikan timestamps otomatis
    public $timestamps = false;
    protected $table = 'account';

    protected $fillable = [
        'username',
        'password',
        'id_number',
        'name',
        'role',
        'ldap',
        'created_at'
    ];
}
