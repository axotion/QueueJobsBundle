<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:23
 */

namespace QueueJobsBundle\Worker\Unserializers;

use ddd\Dispatcher\DispatchableInterface;
use ddd\Worker\Unserializers\UnserializeInterface;

class DefaultUnserializer implements UnserializeInterface
{

    public function unserialize(string $serialized_job): DispatchableInterface
    {
        return unserialize($serialized_job);
    }
}