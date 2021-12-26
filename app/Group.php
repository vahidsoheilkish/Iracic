<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Group extends Model
class Group extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];

    protected $guarded = [];

    public function majors(){
        return $this->hasMany(Major::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }
}
