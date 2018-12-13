<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //'posts' name of the table

    // protected $table = 'posts';

    // protected $primaryKey = 'post_id';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'title',
        'content'

    ];

}
