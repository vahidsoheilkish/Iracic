<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model  as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Submenu extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $primaryKey = "_id";


    protected $guarded = [];


    protected $casts = [
        'name' => 'array'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

}
