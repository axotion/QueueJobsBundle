<?php

namespace Evilnet\QueueJobsBundle\Dispatcher\Serializers;

use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;

interface SerializerInterface
{
    public function serialize(DispatchableInterface $dispatchable) : string;
}