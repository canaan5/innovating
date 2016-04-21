<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/27/16
 * Time: 12:03 AM.
 */

namespace Innovating\Routing\Contracts;

interface RouterContract
{
    /**
     * Map a GET Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function get($path, $action);

    /**
     * Map a HEAD Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function head($path, $action);

    /**
     * Map a POST Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function post($path, $action);

    /**
     * Map a PUT Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function put($path, $action);

    /**
     * Map a DELETE Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function delete($path, $action);

    /**
     * Map a PATCH Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function patch($path, $action);

    /**
     * Map a OPTIONS Route to the Router.
     *
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function options($path, $action);

    /**
     * Map a MATCH Route to the Router.
     *
     * @param string|array         $method
     * @param string               $path
     * @param string|array|Closure $action
     */
    public function match($method, $path, $action);

    /**
     * Create a route group with shared attributes.
     *
     * @param array    $attributes
     * @param \Closure $callback
     */
    public function group(array $attributes, \Closure $callback);
}
