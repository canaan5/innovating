<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/26/16
 * Time: 7:56 PM.
 */

namespace Innovating;

use Illuminate\Http\Response;
use Innovating\Contracts\ApplicationInterface;
use Innovating\DIC\Container;
use Innovating\Exceptions\ErrorHandlerService;
use Innovating\ServiceProviders\DatabaseServiceprovider;
use Innovating\ServiceProviders\DefaultServices;
use Innovating\ServiceProviders\RouteServiceProvider;
use Innovating\ServiceProviders\ViewServiceProvider;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application extends Container implements ApplicationInterface, HttpKernelInterface
{
    /**
     * APPLICATION VERSION.
     */
    const VERSION = '1.0.0';

    /**
     * Base Directory of the applciation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Application constructor.
     *
     * @param array $basePath Application base directory
     * @param array $values   array of values to bind to container
     */
    public function __construct($basePath = null)
    {
        static::setInstance($this);
        $this->instance('app', $this);

        if (!is_null($basePath)) {
            $this->setBasePath($basePath);
        }
    }

    /**
     * Get the current version of the application.
     *
     * @return string
     */
    public function version()
    {
        return static::VERSION;
    }

    public function setBasePath($path)
    {
        $this->basePath = rtrim($path, '\/');

        $this->instance('path', $this->basePath.DIRECTORY_SEPARATOR.'app');

        return $this;
    }

    /**
     * Get the base path.
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Get the app path.
     */
    public function appPath()
    {
        return ltrim($this->basePath().'/app', '/');
    }

    /**
     * Get the current Environment.
     *
     * @return string
     */
    public function env()
    {
        // TODO: Implement env() method.
    }

    /**
     * Boot up the application.
     */
    public function start()
    {
        $this->registerDefaultServices();

        $this->handle($this->request->createFromGlobals());
    }

    /**
     * Handles a Request to convert it to a Response.
     *
     * When $catch is true, the implementation must catch all exceptions
     * and do its best to convert them to a Response instance.
     *
     * @param Request $request A Request instance
     * @param int     $type    The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool    $catch   Whether to catch exceptions or not
     *
     * @return Response A Response instance
     *
     * @throws \Exception When an Exception occurs during processing
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $response = $this->app->response->create($this->router->dispatch($request));

        $response->send();
    }

    /**
     * Register Default Services of the application.
     */
    public function registerDefaultServices()
    {
        /*
         * Add Paths to  container
         */
        $this['basePath'] = $this->basePath();
        $this['storagePath'] = $this->basePath().'/storage';
        $this['appPath'] = $this->appPath();

        $this->register(new DefaultServices($this));

        $this->register(new ErrorHandlerService($this));

        // Enable debug based on user configuration
        if (true === $this->app->config->get('app')['debug']) {
            Debug::enable();
            $error = ErrorHandler::register();
            $e = new \Exception();

            var_dump($error->screamAt(100));
        }

        /*
         * retister View Provider
         */
        $this->register(new ViewServiceProvider());

        /*
         * Register Route Provider
         */
        $this->register(new RouteServiceProvider($this));

        /*
         * Register Database Provider
         */
        $this->register(new DatabaseServiceprovider($this));
    }

    /**
     * Register method for registering service providers.
     *
     * @param ServiceProvider $provider
     *
     * @return ServiceProvider|void
     */
    public function register(ServiceProvider $provider)
    {
        if ($ServiceProvider = $this->getProvider($provider)) {
            return $ServiceProvider->register();
        }

        $provider->register();

        return $provider;
    }

    /**
     * Get a service provider.
     *
     * @param ServiceProvider $provider
     *
     * @return ServiceProvider
     */
    public function getProvider(ServiceProvider $provider)
    {
        return $provider;
    }
}
