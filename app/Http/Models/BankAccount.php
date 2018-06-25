<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/03/2018
 * Time: 03:05 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bankaccount';
    protected $fillable = ['account_no','owner_name','imge','swift_code','bank_name'];
    protected $primaryKey = 'bankaccount_id';

}