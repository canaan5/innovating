<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/24/16
 * Time: 9:44 AM
 */

namespace app\Controllers;


use Innovating\Routing\Controller;

class User extends Controller
{

    /**
     * @return mixed view
     */
    public function single($name, $id)
    {
        return "My name is $name and my id is $id";
    }
}