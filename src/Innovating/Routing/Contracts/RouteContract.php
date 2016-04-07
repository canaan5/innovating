<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/29/16
 * Time: 12:23 AM
 */

namespace Innovating\Routing\Contracts;


interface RouteContract
{

    /**
     * get request path passed to Route
     *
     * @return string
     */
    public function getUri();

    /**
     * get Request methods
     *
     * @return array request methods
     */
    public function getMethods();

    /**
     * Get the route action
     *
     * @return \Closure|Callable|string
     */
    public function getAction();


}