<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSubjects extends Pivot
{
    protected $table = 'user_subjects';

    protected $fillable = [
        'user_id',
        'subject_id',
    ];
}
