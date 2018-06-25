<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    //

    protected $fillable =['year','grade_id'];
    protected $primaryKey = 'year_id';
    protected $table = 'year';


    public function Year(){
        return $this->hasMany('App\Http\Models\Users','year');
    }
}
