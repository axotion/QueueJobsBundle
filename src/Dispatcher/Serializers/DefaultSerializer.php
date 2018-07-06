<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:23
 */

namespace Evilnet\QueueJobsBundle\Dispatcher\Serializers;

use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;

class DefaultSerializer implements SerializerInterface
{
    public function serialize(DispatchableInterface $dispatchable): string
    {
        return serialize($dispatchable);
    }
}