<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestCourse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'description_for_admin', 'offer_price', 'teacher_id', 'category_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
