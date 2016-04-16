<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/4/16
 * Time: 5:24 AM.
 */

namespace app\Controllers\Blog;

use Innovating\Routing\Controller;

class Blog extends Controller
{
    public function index()
    {
        return 'Blog index view';
    }

    public function single($id)
    {
        return "Single blog post with id ($id)";
    }
}
