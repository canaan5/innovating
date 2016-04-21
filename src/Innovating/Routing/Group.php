<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/20/16
 * Time: 2:46 PM.
 */

namespace Innovating\Routing;

use Innovating\Routing\Contracts\RouteCollectionContract;
use Innovating\Routing\Contracts\RouterContract;

class Group implements RouterContract
{
    use RouteStoreTrait;
    use RouteVerbTrait;
    /**
     * Group Attributes (prefix, namespace...).
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * Group constructor.
     *
     * @param array    $attributes
     * @param \Closure $callback
     */
    public function __construct(array $attributes = [], \Closure $callback, RouteCollectionContract $routes)
    {
        $this->attributes = $attributes;
        $this->callback = $callback;
        $this->routes = $routes;

        $this->processGroupRoute();
    }

    /**
     * execute Group closure to add the routes to the collection.
     */
    public function processGroupRoute()
    {
        call_user_func_array($this->callback, [$this]);
    }

    /**
     * add route the our route stack.
     *
     * @param $method array
     * @param $path string
     * @param $action \Closure|array
     */
    public function addToRoute($method, $path, $action)
    {
        // check and add uri prefix to group uri
        $path = $this->parseGroupPrefix($path);

        // if routing to a controller, add the namespace.
        if (is_array($action)) {
            $action = $this->parseNamespace($action);
        }

        $path = ($path === '/') ? '/' : rtrim($path, '/');

        $this->routes->add(new Route($method, $path, $action));
    }

    /**
     * Add group prefix to route uri.
     *
     * @param string $path Route Uri
     *
     * @return string
     */
    public function parseGroupPrefix($path)
    {
        // check if its a group route and it has prefix,
        // if it have prefix, add the prefix to the path
        if (isset($this->attributes['prefix'])) {
            $path = $this->attributes['prefix'].'/'.$path;
        }

        return $path;
    }

    /**
     * Add namespace to controller class.
     *
     * @param array $action
     *
     * @return mixed
     */
    public function parseNamespace($action)
    {
        list($class, $method) = $action;
        $namespace = $this->attributes['namespace']."\\$class" ?: $class;
        $action[0] = $namespace;

        return $action;
    }
}
