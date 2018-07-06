<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:30
 */

namespace ddd\QueueAdapter;


interface QueueAdapterInterface
{
    public function push(string $serialized_dispatchable, string $queue = 'default') : void;
    public function pop(string $queue = 'default') : ?string;
}