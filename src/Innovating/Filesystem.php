<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/12/16
 * Time: 2:13 PM.
 */

namespace Innovating;

class Filesystem
{
    /**
     * check if a file exist and return true if it does else false.
     *
     * @param string $file path
     *
     * @return bool
     */
    public function exists($file)
    {
        return file_exists($file);
    }

    /**
     * check if is a file and return true else false if not.
     *
     * @param string $file path
     *
     * @return bool
     */
    public function isFile($file)
    {
        return is_file($file);
    }

    /**
     * check if the given path is a directory and return true else false if not.
     *
     * @param string $path path
     *
     * @return bool
     */
    public function isDir($path)
    {
        return is_dir($path);
    }

    /**
     * check if directory is empty and return true if it is else false.
     *
     * @param string $dir
     *
     * @return bool
     */
    public function dirEmpty($dir)
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            if ($value === '.' || $value === '...') {
                unset($files[$key]);
            }
        }

        //Directory is empty
        if (sizeof($files) === 0) {
            return true;
        }

        // Directory is not empty
        return false;
    }

    /**
     * Return true if path is readable otherwise false.
     *
     * @param string $path
     *
     * @return bool
     */
    public function isReadable($path)
    {
        return is_readable($path);
    }

    /**
     * Return true if path is writable otherwise false.
     *
     * @param string $path
     *
     * @return bool
     */
    public function isWritable($path)
    {
        return is_writable($path);
    }

    /**
     * Get file size.
     *
     * @param $file
     *
     * @return int
     */
    public function size($file)
    {
        return filesize($file);
    }

    /**
     * Get file extension.
     *
     * @param $file
     *
     * @return string
     */
    public function extension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Get file mime type.
     *
     * @param $file
     *
     * @return string
     */
    public function mimeType($file)
    {
        return mime_content_type($file);
    }

    /**
     * Delete file.
     *
     * @param $file
     *
     * @return bool
     */
    public function delete($file)
    {
        if ($this->exists($file)) {
            return unlink($file);
        }
    }

    /**
     * Delete Directory.
     *
     * @param $dir
     *
     * @return bool
     */
    public function deleteDir($dir)
    {
        return rmdir($dir);
    }

    /**
     * Find pathnames matching a given pattern.
     *
     * @param $pattern
     *
     * @return array|false
     */
    public function glob($pattern)
    {
        return glob($pattern, 0);
    }

    /**
     * Get the content of a file.
     *
     * @param $file
     *
     * @return string|false
     */
    public function get($file)
    {
        return $this->isFile($file) ? file_get_contents($file) : false;
    }

    /**
     * Add data to a file if exist or create the file if it does not exist.
     *
     * @param $file
     * @param $data
     *
     * @return mixed
     */
    public function put($file, $data, $lock = false)
    {
        return file_put_contents($file, $data, $lock ? LOCK_EX : 0);
    }

    /**
     * Add data to the end of a file file.
     *
     * @param $file
     * @param $data
     *
     * @return mixed
     */
    public function append($file, $data)
    {
        return file_put_contents($file, $data, FILE_APPEND);
    }

    /**
     * Add data to the Beginning of a file file.
     *
     * @param $file
     * @param $data
     *
     * @return mixed
     */
    public function prepend($file, $data)
    {
        if ($this->exists($file)) {
            return $this->put($file, $data.$this->get($file));
        }

        return $this->put($file, $data);
    }

    /**
     * Create a New Directory.
     *
     * @param string $path
     * @param int    $mode
     * @param bool   $recursive
     *
     * @return bool
     */
    public function makeDir($path, $mode = 0775, $recursive = false)
    {
        return mkdir($path, $mode, $recursive);
    }

    public function timeModified($file)
    {
        return filemtime($file);
    }
}
