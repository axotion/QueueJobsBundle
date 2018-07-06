<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:34
 */

namespace ddd\Worker\Unserializers;


use ddd\Dispatcher\DispatchableInterface;
use ddd\Worker\Unserializers\UnserializeInterface;

class JsonUnserializer implements UnserializeInterface
{
    public function unserialize(string $serialized_job): DispatchableInterface
    {
        return json_decode($serialized_job);
    }
}