<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:21
 */

namespace Evilnet\Dispatcher\Serializers;

use Evilnet\Dispatcher\DispatchableInterface;

interface SerializerInterface
{
    public function serialize(DispatchableInterface $dispatchable) : string;
}