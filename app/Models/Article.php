<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title','slug','short_description','description','status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/article/' . $val) : "";

    }

}
