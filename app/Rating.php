<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function save(array $options = [])
    {
        if(empty($this->slug)){
            $this->slug = urlencode(str_replace(' ', '_', $this->name));
        }
        return parent::save($options);
    }
}
