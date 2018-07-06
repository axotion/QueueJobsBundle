<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:34
 */

namespace ddd\Dispatcher\Serializers;


use ddd\Dispatcher\DispatchableInterface;

class JsonSerializer implements SerializerInterface
{

    public function serialize(DispatchableInterface $dispatchable): string
    {
        return json_encode($dispatchable);
    }
}