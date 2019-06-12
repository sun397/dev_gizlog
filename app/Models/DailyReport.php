<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'contents',
        'reporting_time'
    ];

    protected $table = 'daily_reports';
    protected $dates = [
        'deleted_at',
        'reporting_time'
    ];

    public function getAll($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function searchDaily($input)
    {
        return $this->where('reporting_time', 'LIKE', "%{$input}%")->get();
    }
}
