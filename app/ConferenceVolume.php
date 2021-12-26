<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class ConferenceVolume extends Eloquent
{
    protected $guarded = [];
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";


    public function conference(){
        return $this->belongsTo(Conference::class , 'conference_id');
    }

    public function articles(){
        return $this->hasMany(ConferenceArticle::class);
    }
}
