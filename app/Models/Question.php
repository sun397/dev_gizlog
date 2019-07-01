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

    public function getAuth($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function searchQuestion($search_category, $search_word)
    {
        if (!empty($search_word)) {
            return $this->where('title', 'LIKE', "%{$search_word}%")->get();
        } elseif (!empty($search_category)) {
            return $this->where('tag_category_id', $search_category)->get();
        } elseif ($search_category === '0') {
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
