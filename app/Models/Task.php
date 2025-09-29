<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'deadline',
        'completed',
    ];

    protected $dates = ['deadline'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->deadline < now()->toDateString()) {
                session()->flash('error', 'Nelze uložit úkol s minulým termínem. Zvolte prosím budoucí datum.');
                return false;
            }
        });
    }
}
