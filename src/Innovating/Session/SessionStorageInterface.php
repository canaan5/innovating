<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/12/16
 * Time: 2:09 PM.
 */

namespace Innovating\Session;

interface SessionStorageInterface
{
    /**
     * Return The session ID of empty.
     *
     * @return string
     */
    public function getId();

    /**
     * Set the session ID.
     *
     * @return string $id
     */
    public function setId($id);

    /**
     * Start Session.
     *
     * @return bool True or False
     */
    public function start();

    /**
     * Check if session is started.
     *
     * @return bool True or False
     */
    public function started();

    /**
     * Get the name of the session.
     *
     * @return mixed session name
     */
    public function getName();

    /**
     * Set the session name.
     *
     * @param $name new Session name
     *
     * @return string session name
     */
    public function setName($name);

    /**
     * Regenerate the session id.
     *
     * @param bool $destroy
     *
     * @return bool True or False
     */
    public function regenerateId($destroy = false);

    /**
     * Read and return session.
     *
     * @param string $id Session ID
     *
     * @return array
     */
    public function read($id);

    /**
     * Clear all session Data.
     */
    public function clear();

    /**
     * Clean up expired session.
     *
     * @param $maxLifeTime
     *
     * @return bool
     */
    public function gc($maxLifeTime);
}
