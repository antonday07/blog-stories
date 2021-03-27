<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];


    public function user() {
        return $this->belongsTo(User::class);
    }
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }



    // Eloquent to get category_post and post_tag
    public function category_post() {
        return $this->hasMany(PostCategory::class);
    }

    public function post_tag() {
        return $this->hasMany(PostTag::class);
    }




    //Method to list categories and tags

    public function categoriesList() {
        $idsCat =  $this->categories()->pluck('category_id');
     //   dd($this->categories);
        return Category::find($idsCat)->pluck('title')->toArray();

    }

    public function tagsList() {
        $idsTag = $this->tags()->pluck('tag_id');
        return Tag::find($idsTag)->pluck('title')->toArray();
    }



    public function getRouteKeyName()
    {
        return 'slug';
    }
}
