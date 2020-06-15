<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function setPostImageAttribute($value) {
    //     $this->attributes['post_image'] = asset($value);
    // }

    public function getPostImageAttribute($value){

        $word = "lorempixel";
        
        if(strpos($value,$word) !== false){
            return asset($value);}
        // only lorempixel image will display
        else{
            return asset('storage/'.$value);
        } 
    }

    


}
