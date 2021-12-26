<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Publication extends Model
class Publication extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];

    protected $guarded = [];

    public function getGroup(){
        $group = Group::where('_id',$this->group_id)->first();
        return $group;
    }

    public function getMajor(){
        $major = Major::where('_id',$this->major_id)->first();
        return $major;
    }


    public function path(){
        return "/journal/{$this->_id}";
    }

    public function major(){
        return $this->hasOne(Major::class);
    }

    public function group(){
        return $this->hasOne(Group::class);
    }

    public function publication_user(){
        return $this->belongsTo(PublicationUser::class);
    }

    public function volumes(){
        return $this->hasMany(Volume::class);
    }

    public function latestVolumeIssue(){
        return $this->volumes()->with("issues");
    }
}
