<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class ConferenceUser extends Model
class ConferenceUser extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];

    protected $guarded = [];

    public function conference(){
        return $this->hasOne(Conference::class , 'conference_user_id' );
    }

    public function notification(){
        return $this->hasMany(ConferenceNotification::class);
    }

}
