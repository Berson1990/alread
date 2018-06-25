<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $primaryKey='answer_id';
    protected $table='answer';
    protected  $fillable =['question_id','answer','audio_url','image_url','rate'];
}
