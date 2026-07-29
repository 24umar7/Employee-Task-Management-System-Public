<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'taskId';

    protected $fillable = [
        'userId',
        'title',
        'description',
        'deadline',
        'status',
        'screenshot',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}