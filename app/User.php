<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

//class User extends Authenticatable
//class User extends Model
class User extends Authenticatable
{
    use HybridRelations, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";
    protected $casts = [
        '_id' => 'string'
    ];

    protected $fillable = [
        'name', 'password', 'family','dependency','melicode','mobile','organization_type','job','group_id','major_id','imgUrl','address','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'level', 'remember_token'
    ];

    public function isAdmin(){
        return $this->level == 'admin' ? true : false;
    }

    public function notification(){
        return $this->hasMany(UsersNotification::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
