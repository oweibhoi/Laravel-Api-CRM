<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'email',
        'address',
        'city',
        'state',
        'postal_code',
        'phone',
        'status'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function todos()
    {
        return $this->hasMany(Todos::class, 'customer_id');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'customer_id');
    }
}
