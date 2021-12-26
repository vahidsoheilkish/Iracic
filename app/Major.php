<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Major extends Model
class Major extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";

    protected $casts = [
         '_id' => 'string'
    ];


    protected $guarded = [];

    public function group(){
//        return $this->belongsTo(Group::class,'group_id');
        return $this->belongsTo(Group::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }

}
