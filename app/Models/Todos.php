<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory;

    protected $table = 'customer_todos';

    protected $fillable = [
        'customer_id',
        'todo_id',
    ];

    public function settingsTodos () {
        return $this->belongsTo(SettingsTodos::class, 'todo_id');
    }

    public function customer () {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
