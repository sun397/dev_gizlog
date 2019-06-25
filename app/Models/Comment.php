<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'comment',
    ];

    protected $table = 'commets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
