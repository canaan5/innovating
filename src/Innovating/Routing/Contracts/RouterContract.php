<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/27/16
 * Time: 12:03 AM
 */

namespace Innovating\Routing\Contracts;


interface RouterContract
{
    /**
     * Map a GET Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function get($path, $action);

    /**
     * Map a POST Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function post($path, $action);

    /**
     * Map a PUT Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function put($path, $action);

    /**
     * Map a DELETE Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function delete($path, $action);

    /**
     * Map a PATCH Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function patch($path, $action);

    /**
     * Map a OPTIONS Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function options($path, $action);

    /**
     * Map a MATCH Route to the Router.
     *
     * @param String|Array $method
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function match($method, $path, $action);

    /**
     * Create a route group with shared attributes.
     *
     * @param  array     $attributes
     * @param  \Closure  $callback
     * @return void
     */
    public function group(array $attributes, \Closure $callback);
}