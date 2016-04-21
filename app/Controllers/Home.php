<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/24/16
 * Time: 9:44 AM.
 */

namespace app\Controllers;

use app\Model\User;

class Home extends Controller
{
    /**
     * @return mixed view
     */
    public function index()
    {
        return $this->view('home');
    }

    function user($id)
    {
        return User::find($id);
    }
}
