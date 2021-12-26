<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Conference extends Model
class Conference extends Eloquent
{
    use HybridRelations;

    protected $connection = 'mongodb';
    protected $primaryKey = "_id";

    protected $guarded = [];

    protected $casts = [
        'title' => 'array' ,
        'description' => 'array' ,
        'conference_subjects' => 'array' ,
         '_id' => 'string'
    ];

    public function path(){
        return "/conference/{$this->slug}";
    }

    public function conference_user(){
        return $this->belongsTo(ConferenceUser::class , 'id');
    }

    public function volumes(){
        return $this->hasMany(ConferenceVolume::class, 'conference_id');
    }


}
