<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Volume extends Model
class Volume extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $guarded = [];

    public function publication(){
        return $this->belongsTo(Publication::class);
    }

    public function issues(){
        return $this->hasMany(Issue::class);
    }
}
