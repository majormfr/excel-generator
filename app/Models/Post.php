<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey='uuid';

    public function getTitleAttribute($value) {
        return lcfirst($value);
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = "{$value} is banned";
    }

    public function scopeTitleBanned($query){
        return $query->where('title','LIKE','%banned%');
    }

    public function postmedia(){
        return $this->morphOne(Image::class,'imageable');
    }

}
