<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/20/16
 * Time: 3:23 PM.
 */

namespace Innovating\Routing;

trait RouteVerbTrait
{
    /**
     * Map a GET Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function get($path, $action)
    {
        $this->addToRoute('GET', $path, $action);
    }

    /**
     * Map a HEAD Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function head($path, $action)
    {
        $this->addToRoute('HEAD', $path, $action);
    }

    /**
     * Map a POST Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function post($path, $action)
    {
        $this->addToRoute('POST', $path, $action);
    }

    /**
     * Map a PUT Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function put($path, $action)
    {
        $this->addToRoute('PUT', $path, $action);
    }

    /**
     * Map a DELETE Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function delete($path, $action)
    {
        $this->addToRoute('DELETE', $path, $action);
    }

    /**
     * Map a PATCH Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function patch($path, $action)
    {
        $this->addToRoute('PATCH', $path, $action);
    }

    /**
     * Map a OPTIONS Route to the Router.
     *
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function options($path, $action)
    {
        $this->addToRoute('OPTIONS', $path, $action);
    }

    /**
     * Map a MATCH Route to the Router.
     *
     * @param string|array          $method
     * @param string                $path
     * @param string|array|\Closure $action
     */
    public function match($method, $path, $action)
    {
        $this->addToRoute(['GET', 'POST', 'DELETE', 'PUT', 'PATCH', 'HEAD'], $path, $action);
    }

    /**
     * Create a route group with shared attributes.
     *
     * @param array    $attributes
     * @param \Closure $callback
     */
    public function group(array $attributes, \Closure $callback)
    {
        $groupRoute = new Group($attributes, $callback, $this->routes);
        // save the attributes and execute the closure
        $this->groupStack[] = $groupRoute;

        return $groupRoute;
    }
}
