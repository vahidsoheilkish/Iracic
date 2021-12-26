<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;


//class ConferenceArticle extends Model
class ConferenceArticle extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";

    protected $guarded = [];
    protected $casts = [
        'title' => 'array' ,
        'abstract' => 'array' ,
        'authors_info' => 'array' ,
        'structure' => 'array' ,
        'resource' => 'array' ,
         '_id' => 'string'
    ];

//    public function conferenceArticleInfo(){
//        return $this->hasOne(ConferenceArticleInfo::class);
//    }

    public function volume(){
        return $this->belongsTo(ConferenceVolume::class,'conference_volume_id' );
    }
}
