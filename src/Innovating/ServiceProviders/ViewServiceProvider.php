<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/27/16
 * Time: 5:38 AM
 */

namespace Innovating\ServiceProviders;


use Illuminate\Events\Dispatcher;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Innovating\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
         * application default view
         *
         * @param $c container
         * @return Factory view Factory
         */
        $this->app['view'] = function($c) {

            $viewPath = [$this->app->path . '/View'];
            $compiledView = $this->app->basePath() . '/storage/view';

            $viewResolver = new EngineResolver();

            $compiler = new BladeCompiler($c['filesystem'], $compiledView);

            $filesystem = $c['filesystem'];

            $viewResolver->register('blade', function() use( $compiler, $filesystem)
            {
                return new CompilerEngine($compiler, $filesystem);
            });

            $viewResolver->register('php', function() {
                return new PhpEngine();
            });

            $viewFinder = new FileViewFinder($filesystem, $viewPath);
            $viewFactory = new Factory($viewResolver, $viewFinder, new Dispatcher());

            return $viewFactory;

        };

    }
}