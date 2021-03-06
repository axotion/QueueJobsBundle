<?php

namespace  Evilnet\QueueJobsBundle\Dispatcher;

use Evilnet\QueueJobsBundle\QueueAdapter\QueueAdapterInterface;
use Evilnet\QueueJobsBundle\Dispatcher\Serializers\SerializerInterface;

class Dispatcher implements DispatcherInterface
{
    protected $serializer;
    protected $driver;

    public function __construct(SerializerInterface $serializer, QueueAdapterInterface $driver)
    {
        $this->serializer = $serializer;
        $this->driver = $driver;
    }

    public function dispatch(DispatchableInterface $dispatchable, string $queue) : void
    {
        $serialized_dispatchable = $this->serializer->serialize($dispatchable);
        $this->driver->push($serialized_dispatchable, $queue);
    }
}