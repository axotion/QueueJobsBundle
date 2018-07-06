<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:44
 */

namespace ddd\Worker\Unserializers;


use ddd\Dispatcher\DispatchableInterface;

interface UnserializeInterface
{
    public function unserialize(string $serialized_job) : DispatchableInterface;
}