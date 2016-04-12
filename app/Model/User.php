<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/23/16
 * Time: 2:19 PM
 */

namespace app\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['full_name', 'email', 'password'];

    protected $hidden = ['password'];

}