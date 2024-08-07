<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsTodos extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    public function todos () {
        return $this->belongsTo(Todos::class, 'todo_id');
    }
}
