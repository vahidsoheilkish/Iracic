<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class CategoryPost extends Model
class CategoryPost extends Eloquent
{
    public $timestamps = false;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];


    use HybridRelations;
    protected $table = "category_post";
    protected $guarded = [];
}
