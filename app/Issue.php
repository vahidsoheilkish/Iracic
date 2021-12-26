<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Issue extends Model
class Issue extends Eloquent
{
    use HybridRelations;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];


    public function volume(){
        return $this->belongsTo(Volume::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
