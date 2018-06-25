<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Weak extends Model
{
    //
    protected $table ='weaks';
    protected $fillable = ['week'];
    protected $primaryKey = 'week_id';

    public function lesson(){
        return $this->hasMany('App\Http\Models\Lesson','week_id');
    }
    public function test(){
        return $this->hasMany('App\Http\Models\Test','week_id');
    }
}
