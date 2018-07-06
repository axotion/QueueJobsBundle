<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:38
 */

namespace Evilnet\Worker;


interface WorkerInterface
{
    public function work(string $queue = 'default', int $retry = 1) : void;
}