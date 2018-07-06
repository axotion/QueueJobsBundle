<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:21
 */

namespace ddd\Dispatcher\Serializers;

use ddd\Dispatcher\DispatchableInterface;

interface SerializerInterface
{
    public function serialize(DispatchableInterface $dispatchable) : string;
}