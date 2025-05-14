<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'dni',
        'name',
        'surnames',
        'role',
        'computer_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $attributes = [
        'role' => 'student',
    ];


    public function computer()
    {
        return $this->belongsTo(Computer::class, 'computer_id');
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function classroomsAsTeacher() {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    public function classroom()
{
    return $this->hasOneThrough(
        Classroom::class,   
        Board::class,       
        'id',               
        'id',               
        'computer_id',      
        'classroom_id'      
    );
}
     
}
