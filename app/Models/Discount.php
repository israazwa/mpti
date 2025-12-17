<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'starts_at',
        'ends_at',
        'is_active'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}