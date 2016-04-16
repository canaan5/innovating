<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/7/16
 * Time: 3:12 PM.
 */

namespace Innovating\ServiceProviders;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Innovating\ServiceProvider;

class DatabaseServiceprovider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $manager = new Manager();
        $manager->addConnection($this->app->config->get('database')['default']);
        $manager->setEventDispatcher(new Dispatcher());
        $manager->setAsGlobal();
        $manager->bootEloquent();
    }
}
