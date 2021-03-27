<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $guarded = [];

    public $table = 'category_post';

    public $timestamps = true;
}
