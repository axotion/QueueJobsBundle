<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:26
 */

namespace Evilnet\Dispatcher;

use Evilnet\QueueAdapter\QueueAdapterInterface;
use Evilnet\Dispatcher\Serializers\SerializerInterface;

class Dispatcher implements DispatcherInterface
{
    protected $serializer;
    protected $driver;

    public function __construct(SerializerInterface $serializer, QueueAdapterInterface $driver)
    {
        $this->serializer = $serializer;
        $this->driver = $driver;
    }

    public function dispatch(DispatchableInterface $dispatchable, string $queue = 'default') : void
    {
        $serialized_dispatchable = $this->serializer->serialize($dispatchable);
        $this->driver->push($serialized_dispatchable, $queue);
    }
}