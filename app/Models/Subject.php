<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'image',
        'teacher_id'
    ];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subjects')
            ->using(UserSubjects::class);
    }
}
