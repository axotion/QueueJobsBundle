<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:51
 */

namespace Evilnet\Dispatcher;

interface DispatcherInterface
{
    public function dispatch(DispatchableInterface $dispatchable, string $queue = 'default'): void;
}