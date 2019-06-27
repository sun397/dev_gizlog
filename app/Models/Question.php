<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\TagCategory;
use App\Models\Comment;

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

    public function getAll($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function searchWord($search_word)
    {
        return $this->where('title', 'LIKE', "%{$search_word}%")->get();
    }

    public function searchCategory($search_category)
    {
        return $this->where('tag_category_id', 'LIKE', "%{$search_category}%")->get();
    }

    public function comment()
    {
		    return $this->hasMany(Comment::class, 'question_id');
	  }

    public function category()
    {
		    return $this->belongsTo(TagCategory::class, 'tag_category_id');
	  }

    public function user()
    {
		    return $this->belongsTo(User::class);
	  }
}
