<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/26/16
 * Time: 9:33 PM
 */

namespace Innovating\ServiceProviders;

use Innovating\DIC\Container;
use Innovating\Routing\Router;
use Innovating\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register()
    {
        /**
         * @param $c \Innovating\DIContainer
         * @return \Canaan5\Routing\Router
         */
        $this->app['router'] = $this->app->share(function($app) {
            return new Router($app);
        });

        $router = $this->app->router;

        require '/'.$this->app->appPath() .'/routes.php';

    }
}