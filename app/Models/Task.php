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
            $TasksCount = Task::where('deadline', $model->deadline)->count();
            if ($TasksCount > 2) {
                session()->flash('error', 'Nelze mít víc než 2 úkoly se stejným termínem. Zvolte jiný termín, prosím');
                return false;
            }
        });
    }
}
