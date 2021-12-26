<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Category extends Model
class Category extends Eloquent
{
    use HybridRelations;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];


    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
