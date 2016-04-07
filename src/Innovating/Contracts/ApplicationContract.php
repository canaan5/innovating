<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 3/26/16
 * Time: 2:39 PM
 */

namespace Innovating\Contracts;


interface ApplicationContract
{

    /**
     * Get the current version of the application
     *
     * @return string
     */
    public function version();

    /**
     * Get the base path
     *
     * @return string
     */
    public function basePath();

    /**
     * Get the current Environment
     *
     * @return string
     */
    public function env();

    /**
     * Boot up the application
     *
     * @return void
     */
    public function start();
}