<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/7/16
 * Time: 3:12 PM
 */

namespace Innovating\ServiceProviders;


use Illuminate\Database\Capsule\Manager;
use Innovating\ServiceProvider;

class DatabaseServiceprovider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $manager = new Manager();

        $manager->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'test',
            'username'  => 'kesty',
            'password'  => 'CanaaN55*',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $manager->setEventDispatcher($this->app['dispatcher']($this));
        
    }
}
