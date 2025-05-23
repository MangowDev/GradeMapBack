<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = [
        'name',
        'teacher_id'
    ];

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function boards() {
        return $this->hasMany(Board::class, 'classroom_id');
    }
    
    
}
