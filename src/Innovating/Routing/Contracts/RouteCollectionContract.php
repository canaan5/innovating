<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/29/16
 * Time: 12:07 AM.
 */

namespace Innovating\Routing\Contracts;

use Innovating\Http\Request;

interface RouteCollectionContract
{
    /**
     * Add a route to the route collection.
     *
     * @param $route
     */
    public function add(RouteContract $route);

    /**
     * match a route against the current request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function match(Request $request);
}
