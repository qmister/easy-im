<?php

namespace iphper\easyIm\Kernel\Clients;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use iphper\easyIm\Kernel\BaseClient;


class LoggerClient extends BaseClient
{


    /**
     * @var array
     */
    protected $lconfig = [
        'channel' => 'easy-im',
        'stream'  => null,
        'level'   => Logger::DEBUG
    ];


    /**
     * @return mixed|void
     */
    protected function _initialize()
    {
        $this->lconfig = array_merge($this->lconfig, $this->config['logger']);
    }

    /**
     * @param $channel
     * @return string
     */
    protected function stream($channel)
    {
        return $this->lconfig['stream'] ?:
            './runtime' . DIRECTORY_SEPARATOR . $channel . DIRECTORY_SEPARATOR . date('Ymd') . '.log';
    }

    /**
     * @param $channel
     * @return Logger
     */
    public function channel($channel)
    {
        $logger = new Logger($channel);
        $logger->pushHandler(new StreamHandler($this->stream($channel), $this->lconfig['level']));
        return $logger;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->channel($this->lconfig['channel'])->$name(...$arguments);
    }
}