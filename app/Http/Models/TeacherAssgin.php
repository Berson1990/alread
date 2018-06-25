<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAssgin extends Model
{
    //
    protected $primaryKey ='assgin_id';
    protected $table ='teatcherassgin';
    protected $fillable =['teacher_id','grade_id','year_id','subject_id',];
}
