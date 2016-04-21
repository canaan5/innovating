<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/20/16
 * Time: 5:55 PM
 */

namespace app\Controllers\Admin;

use app\Controllers\Controller;

class User extends Controller
{
    function single($id)
    {
        return \app\Model\User::find($id);
    }
}