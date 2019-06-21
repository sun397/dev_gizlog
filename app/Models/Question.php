<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'content',
        'tag_category_id',
    ];

    public function getAll($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
