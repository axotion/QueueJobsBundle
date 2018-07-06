<?php

namespace QueueJobsBundle\QueueAdapter;


interface QueueAdapterInterface
{
    public function push(string $serialized_dispatchable, string $queue = 'default') : void;
    public function pop(string $queue = 'default') : ?string;
}