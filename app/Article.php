<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Article extends Model
class Article extends Eloquent
{
    use HybridRelations ;
    protected $primaryKey = "_id";
    protected $connection = 'mongodb';
    protected $guarded = [];
    protected $casts = [
        'title' => 'array' ,
        'abstract' => 'array' ,
        'authors_info' => 'array' ,
        'structure' => 'array' ,
        'resource' => 'array' ,
         '_id' => 'string'
    ];

    public function issue(){
        return $this->belongsTo(Issue::class);
//        return $this->embedsOne(Issue::class);
    }
}
