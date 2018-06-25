<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestions extends Model
{
    //
    protected $primaryKey='questaion_id';
    protected $fillable=['questaion','answer_1','answer_2','answer_3','correct','test_id'];
    protected $table='testsquestaion';
}
