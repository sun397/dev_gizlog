<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'tag_category_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getMyQuestion($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function searchQuestion($searchCategory, $searchWord)
    {
        if (!empty($searchWord) && !empty($searchCategory)) {
            return $this->where('title', 'LIKE', "%{$searchWord}%")->where('tag_category_id', $searchCategory)->get();
        } elseif (!empty($searchCategory)) {
            return $this->where('tag_category_id', $searchCategory)->get();
        } elseif (!empty($searchWord)) {
            return $this->where('title', 'LIKE', "%{$searchWord}%")->get();
        } else {
            return $this->get();
        }
    }

    public function category()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
