<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $table = 'computers';

    protected $fillable = [
        'board_id',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'computer_id');
    }
}
