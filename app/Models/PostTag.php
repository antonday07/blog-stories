<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $guarded = [];

    public $table = 'post_tag';

    public $timestamps = true;
}
