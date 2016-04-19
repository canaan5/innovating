<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/17/16
 * Time: 3:32 AM.
 */

namespace Innovating\Log;

use Illuminate\Contracts\Events\Dispatcher;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogHandler implements LoggerInterface
{
    /**
     * Monolog Logger instance.
     *
     * @var Logger
     */
    protected $logger;

    /**
     * Application Events instance.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * LogHandler constructor.
     *
     * @param Logger     $log
     * @param Dispatcher $events
     */
    public function __construct(Logger $logger, Dispatcher $events = null)
    {
        $this->logger = $logger;
        $this->events = $events;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = array())
    {
        $this->log(Logger::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = array())
    {
        $this->log(Logger::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = array())
    {
        $this->log(Logger::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = array())
    {
        $this->log(Logger::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     */
    public function warning($message, array $context = array())
    {
        $this->log(Logger::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = array())
    {
        $this->log(Logger::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = array())
    {
        $this->log(Logger::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = array())
    {
        $this->log(Logger::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = array())
    {
        $this->logger->{$this->logger->getLevelName($level)}($message, $context);
    }

    public function fileLogger($path, $level = 'debug')
    {
        $this->logger->pushHandler($handler = new StreamHandler($path, 'debug'));
        $handler->setFormatter(new LineFormatter(null, null, true, true));
    }
}
