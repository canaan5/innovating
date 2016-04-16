<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/6/16
 * Time: 3:32 PM.
 */

namespace Innovating\Routing;

use Innovating\DIC\Container;

abstract class Controller
{
    /**
     * container instance.
     *
     * @var object
     */
    protected $container;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    /**
     * load a view with or without data to the consumer.
     *
     * @param $view
     * @param array $data
     *
     * @return mixed
     */
    public function view($view, array $data = [])
    {
        return $this->container->view->make($view, $data);
    }
}
