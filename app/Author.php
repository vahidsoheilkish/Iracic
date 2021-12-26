<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

//class Author extends Model
class Author extends Eloquent
{
    use HybridRelations;
    protected $primaryKey = "_id";
    protected $connection = 'mongodb';
    protected $guarded = [];
    protected $casts = [
        '_id' => 'string'
    ];
}
