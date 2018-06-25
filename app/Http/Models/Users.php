<?php

namespace App\Http\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $primaryKey = 'user_id';
    protected $fillable = ['name', 'phone', 'password', 'password_confirm', 'mail', 'type', 'grade', 'year', 'image', 'token_id', 'state'];
    protected $table = 'users';

    public function TeacherAssgin()
    {

        return $this->hasMany('App\Http\Models\TeacherAssgin', 'teacher_id');
    }


}


