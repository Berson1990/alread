<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/03/2018
 * Time: 03:32 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class AboutPolicy extends Model
{
    protected $primaryKey=  'id';
    protected  $fillable = ['policy','about'];
    protected  $table = 'aboutpolicy';

}