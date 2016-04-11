<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/26/16
 * Time: 7:56 PM
 */

namespace Innovating;

use Illuminate\Http\Response;
use Innovating\Contracts\ApplicationContract;
use Innovating\DIC\Container;
use Innovating\ServiceProviders\DatabaseServiceprovider;
use Innovating\ServiceProviders\DefaultServices;
use Innovating\ServiceProviders\RouteServiceProvider;
use Innovating\ServiceProviders\ViewServiceProvider;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application extends Container implements ApplicationContract, HttpKernelInterface
{
    /**
     * APPLICATION VERSION
     */
    const VERSION = '1.0.0';

    /**
     * Base Directory of the applciation
     *
     * @var string
     */
    protected $basePath;


    protected $routes;

    /**
     * Application constructor.
     * @param array $basePath Application base directory
     * @param array $values array of values to bind to container
     */
    public function __construct($basePath = null)
    {
        Debug::enable();
        static::setInstance($this);
        $this->instance('app', $this);

        if ( ! is_null($basePath))
            $this->setBasePath($basePath);
    }

    /**
     * Get the current version of the application
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
     * Get the base path
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Get the app path
     */
    public function appPath()
    {
        return ltrim($this->basePath() . "/app", '/');
    }

    /**
     * Get the current Environment
     *
     * @return string
     */
    public function env()
    {
        // TODO: Implement env() method.
    }

    /**
     * Boot up the application
     *
     * @return void
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
     * @param int $type The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool $catch Whether to catch exceptions or not
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
     * Register Default Services of the application
     */
    public function registerDefaultServices()
    {
        $this['basePath'] = $this->basePath();
        $this['appPath'] = $this->appPath();

        $this->register(new DefaultServices($this));
        $this->register(new ViewServiceProvider($this));
        $this->register(new RouteServiceProvider($this));
        $this->register(new DatabaseServiceprovider($this));
    }

    
    public function register(ServiceProvider $provider)
    {
        if ( $ServiceProvider = $this->getProvider($provider) )
            return $ServiceProvider->register();

        $provider->register();

        return $provider;
    }

    public function getProvider(ServiceProvider $provider)
    {
        return $provider;
    }

}
