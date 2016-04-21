<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/20/16
 * Time: 2:56 PM.
 */

namespace Innovating\Routing;

trait RouteStoreTrait
{
    /**
     * add route the our route stack.
     *
     * @param $method array
     * @param $path string
     * @param $action \Closure|array
     */
    abstract public function addToRoute($method, $path, $action);
}
