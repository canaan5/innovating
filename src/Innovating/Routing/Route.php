<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/29/16
 * Time: 12:20 AM.
 */

namespace Innovating\Routing;

use Innovating\Routing\Contracts\RouteContract;

class Route implements RouteContract
{
    /**
     * Path.
     *
     * @var string
     */
    protected $uri;

    /**
     * Route Methods.
     *
     * @var array
     */
    protected $methods = [];

    /**
     * Route Action.
     *
     * @var \Closure|string
     */
    protected $action;

    /**
     * Route parameters.
     *
     * @var array
     */
    protected $parameters = [];

    public function __construct(array $methods, $uri, $action)
    {
        $this->uri = $uri;
        $this->methods = $methods;
        $this->action = $action;
    }

    /**
     * get request path passed to Route.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * get Request methods.
     *
     * @return array request methods
     */
    public function getMethods()
    {
        if (sizeof($this->methods) > 1) {
            foreach ($this->methods as $method) {
                return $method;
            }
        } else {
            return $this->methods;
        }
    }

    /**
     * Get the route action.
     *
     * @return \Closure|callable|string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * set the route paramaters.
     *
     * @param $value array
     */
    public function setParameters($value)
    {
        $this->parameters = $value;
    }

    /**
     * get the current route parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
