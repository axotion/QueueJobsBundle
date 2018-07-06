<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:44
 */

namespace  Evilnet\QueueJobsBundle\Worker\Unserializers;

use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;

interface UnserializeInterface
{
    public function unserialize(string $serialized_job) : DispatchableInterface;
}