<?php

namespace App;

use App\User;
use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $guarded = [];
    
    public function roles(){
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }



}
