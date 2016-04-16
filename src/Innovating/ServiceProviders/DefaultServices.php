<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/27/16
 * Time: 12:36 PM.
 */

namespace Innovating\ServiceProviders;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Innovating\Configuration;
use Innovating\DIC\Container;
use Innovating\ServiceProvider;
use Innovating\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultServices extends ServiceProvider
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
        /*
         * Http request
         *
         * @return \Illuminate\Http\Request Object
         */
        $this->app['request'] = $this->app->share(function () {
            return new Request();
        });

        /*
         * Http Response
         *
         * @return \Symfony\Component\HttpFoundation\Response
         */
        $this->app['response'] = $this->app->share(function () {
            return new Response();
        });

        /*
         * Register Event Dispatcher
         *
         * @return \Illuminate\Events\Dispatcher
         */
        $this->app['dispatcher'] = $this->app->share(function () {
            return new Dispatcher();
        });

        /*
         * Register Event Dispatcher
         *
         * @return \Illuminate\Events\Dispatcher
         */
        $this->app['filesystem'] = $this->app->share(function () {
            return new Filesystem();
        });

        /*
         * Bind Config to the container
         */
        $this->app['config'] = $this->app->share(function () {

            $configFiles = scandir($this->app->basePath().'/config');

            $files = [];
            foreach ($configFiles as $file) {
                if (str_contains($file, '.php')) {
                    $files[str_replace('.php', '', $file)] = require $this->app->basePath()."/config/$file";
                }
            }

            return new Configuration($files);
        });
    }
}
