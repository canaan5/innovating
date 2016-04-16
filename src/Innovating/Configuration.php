<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/11/16
 * Time: 9:31 PM.
 */

namespace Innovating;

class Configuration implements \ArrayAccess
{
    /**
     * @var array
     */
    protected $configs = [];

    /**
     * Configuration constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->configs = $configs;
    }

    /**
     * Get all configuration items.
     *
     * @return array
     */
    public function all()
    {
        return $this->configs;
    }

    /**
     * get a configuration value with the provided key.
     *
     * @param $key
     *
     * @return bool|mixed
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->configs)) {
            return $this->configs[$key];
        }

        return "No config item with key [$key] found";
    }

    /**
     * check if a configuration value exist with the given key.
     *
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->configs);
    }

    public function set($key, $value)
    {
        $this->configs[$key] = $value;
    }

    /**
     * Whether a offset exists.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return bool true on success or false on failure.
     *              </p>
     *              <p>
     *              The return value will be casted to boolean if non-boolean was returned.
     *
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     *
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Offset to set.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Offset to unset.
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->set($offset, null);
    }
}
