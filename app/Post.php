<?php

namespace App;

use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Post as VoyagerPost;

class Post extends VoyagerPost
{

    protected $fillable = [
        'slug', 'name', 'title', 'author_id', 'category_id', 'seo_title', 'excerpt', 'body', 'image', 'slug', 'meta_description', 'meta_keywords', 'status', 'featured',
    ];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->id;
        }

        parent::save();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function syncTagsByName(array $tag_names)
    {
        $tag_ids = [];
        foreach ($tag_names as $name){
            $tag = Tag::where(['name' => $name])->first();
            if(empty($tag)){
                $tag = new Tag(['name' => $name]);
                $tag->save();
            }
            $tag_ids[] = $tag->id;

        }
        $this->tags()->sync($tag_ids);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
