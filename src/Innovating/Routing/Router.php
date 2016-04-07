<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/28/16
 * Time: 11:50 PM
 */

namespace Innovating\Routing;


use \Closure;
use Innovating\DIC\Contracts\Container;
use Innovating\Http\Request;
use Innovating\Routing\Contracts;
use Innovating\Routing\Contracts\RouterContract;

class Router implements RouterContract
{
    /**
     * Container instance
     * @var Container
     */
    protected $container;

    protected $attributes = [];

    protected $routes;

    protected $path;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->routes = new RouteCollection($container->request);
    }

    /**
     * get path to app Controller directory
     *
     * @return string
     */
    public function controllerPath()
    {
        return '\\app\\Controllers\\';
    }

    /**
     * Map a GET Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function get($path, $action)
    {
        $this->addToRoute(['GET', 'HEAD'], $path, $action);
    }

    /**
     * Map a POST Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function post($path, $action)
    {
        $this->addToRoute('POST', $path, $action);
    }

    /**
     * Map a PUT Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function put($path, $action)
    {
        $this->addToRoute('PUT', $path, $action);
    }

    /**
     * Map a DELETE Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function delete($path, $action)
    {
        $this->addToRoute('DELETE', $path, $action);
    }

    /**
     * Map a PATCH Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function patch($path, $action)
    {
        $this->addToRoute('PATCH', $path, $action);
    }

    /**
     * Map a OPTIONS Route to the Router.
     *
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function options($path, $action)
    {
        $this->addToRoute('OPTIONS', $path, $action);
    }

    /**
     * Map a MATCH Route to the Router.
     *
     * @param String|Array $method
     * @param String $path
     * @param String|Array|Closure $action
     * @return void
     */
    public function match($method, $path, $action)
    {
        $this->addToRoute(['GET', 'POST', 'DELETE', 'PUT', 'PATCH', 'HEAD'], $path, $action);
    }

    /**
     * Create a route group with shared attributes.
     *
     * @param  array $attributes
     * @param  \Closure $callback
     * @return void
     */
    public function group(array $attributes, \Closure $callback)
    {
        // save the attributes and execute the closure
        $this->attributes = $attributes;

        call_user_func($callback, $this);
    }

    /**
     * add route the our route stack
     *
     * @param $method array
     * @param $path string
     * @param $action Closure|array
     */
    public function addToRoute($method, $path, $action)
    {
        // check if its a group route and it has prefix,
        // if it have prefix, add the prefix to the path
        if ( isset( $this->attributes['prefix']) )
            $path = $this->attributes['prefix'] . '/' . $path;

        // if routing to a controller, add the namespace.
        if ( is_array($action))
            $action[0] = isset($this->attributes['namespace']) ? $this->attributes['namespace'].'\\'.$action[0] : $action[0];


        $path = $path == '/' ? '/' : rtrim($path, '/');

        $this->routes->add(new Route($method, $path, $action));

    }

    public function dispatch(Request $request)
    {
        // Match the request Uri against the defined routes
        $route = $this->routes->match($request);

        $this->container->instance('Innovating\Routing\Route', $route);

        $action = $route->getAction();

        // if the route action is a closure, return the result to the consumer
        if ( $action instanceof Closure )
            return call_user_func_array($action, $route->getParameters());


        // is action is an array and the length of the array i 2,
        // then we have a controller and a method, return the controller, method and any parameters to the consumer
        if ( is_array($action) && sizeof($action) === 2 )
        {
            $this->container->instance('Innovating\Routing\Controller', $route);
            $class = $this->container->make($this->controllerPath().$action[0]);
            return call_user_func_array([$class, $action[1]], $route->getParameters());
        }

        return $route;
    }

}