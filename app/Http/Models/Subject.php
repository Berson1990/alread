<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = ['name','image','grade_id','year_id'];
    protected $table = 'subject';
    protected $primaryKey ='subject_id';

    public function  grade(){

        return $this->belongsTo('App\Http\Models\Grade','grade_id');
    }
    public function year(){
        return $this->belongsTo('App\Http\Models\Year','year_id');


    }
}
