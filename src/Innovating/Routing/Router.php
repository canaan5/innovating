<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/28/16
 * Time: 11:50 PM.
 */

namespace Innovating\Routing;

use Closure;
use Innovating\DIC\Contracts\Container;
use Innovating\Routing\Contracts\RouterContract;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

class Router implements RouterContract
{
    use RouteStoreTrait;
    use RouteVerbTrait;
    /**
     * Container instance.
     *
     * @var Container
     */
    protected $container;

    protected $groupStack = [];

    protected $routes;

    protected $path;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->routes = new RouteCollection($container);
    }

    /**
     * get path to app Controller directory.
     *
     * @return string
     */
    public function controllerNamespace()
    {
        return '\\app\\Controllers\\';
    }

    /**
     * add route the our route stack.
     *
     * @param $method array
     * @param $path string
     * @param $action Closure|array
     */
    public function addToRoute($method, $path, $action)
    {
        // check if its a group route and it has prefix,
        // if it have prefix, add the prefix to the path
//        if (isset($this->groupStack[0]['prefix'])) {
//            $path = $this->groupStack[0]['prefix'].'/'.$path;
//        }

        // if routing to a controller, add the namespace.
        if (is_array($action)) {
            $action[0] = isset($this->groupStack['namespace']) ? $this->groupStack['namespace'].'\\'.$action[0] : $action[0];
        }

        $path = $path == '/' ? '/' : rtrim($path, '/');

        $this->routes->add(new Route($method, $path, $action));
    }

    public function dispatch(RequestInterface $request)
    {
        // Match the request Uri against the defined routes
        $route = $this->routes->match($request);

        $this->container->instance('Innovating\Routing\Route', $route);

        $action = $route->getAction();

        // if the route action is a closure, return the result to the consumer
        if ($action instanceof Closure) {
            return call_user_func_array($action, $route->getParameters());
        }

        // is action is an array and the length of the array i 2,
        // then we have a controller and a method, return the controller, method and any parameters to the consumer
        if (is_array($action) && sizeof($action) === 2) {
            $this->container->instance('Innovating\Routing\Controller', $route);

            return call_user_func_array([
                $this->container->make($this->controllerNamespace().$action[0]),
                $action[1], ],
                $route->getParameters());
        }

        return $route;
    }
}
