<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/17/16
 * Time: 3:58 AM.
 */

namespace Innovating\Exceptions;

use Innovating\Log\LogHandler;
use Innovating\ServiceProvider;
use Monolog\Logger;

class ErrorHandlerService extends ServiceProvider
{
    /**
     * Register a service provider.
     */
    public function register()
    {
        $this->app->singleton('log', function () {
            $logPath = $this->app->basePath().'/src/storage/logs';
            $logHandler = new LogHandler(new Logger('innovating'));
            $logHandler->fileLogger($logPath.'/innovating.log', Logger::DEBUG);

            return $logHandler;
        });
    }
}
