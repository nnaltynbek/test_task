<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public const FILE_STORE = 'images/news';

    protected $fillable = [
        'title',
        'description',
        'text',
        'image_path',
        'is_published',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    protected $hidden = ['image_path'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        $url = null;
        if ($this->image_path != null) {
            $url = asset($this->image_path);
        }
        return $url;
    }


}
