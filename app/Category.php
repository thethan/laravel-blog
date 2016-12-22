<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category as VoyagerCategory;

class Category extends VoyagerCategory
{

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->where('status', '=', 'PUBLISHED')
            ->orderBy('created_at', 'DESC');
    }
}
