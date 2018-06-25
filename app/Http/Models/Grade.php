<?php

 namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //\
    protected $fillable =['grade'];
    protected $primaryKey = 'grade_id';
    protected $table = 'grade';


    public function Grade(){
        return $this->hasMany('App\Http\Models\Users','grade');
    }
}
