<?php

namespace App;

use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Post as VoyagerPost;

class Post extends VoyagerPost
{

    protected $fillable = [
        'slug', 'name', 'title', 'author_id', 'category_id', 'seo_title', 'excerpt', 'body', 'image', 'slug', 'meta_description', 'meta_keywords', 'status', 'featured',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
