<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Router extends Model
{
    //
    use SoftDeletes;
    protected $fillable = array('ip', 'sapid', 'hostname', 'loopback','mack_address');      

    public function getRouter($id){
        return self::find($id);
    }

}
