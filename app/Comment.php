<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Comment extends Model
class Comment extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];

    protected $guarded=[];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
