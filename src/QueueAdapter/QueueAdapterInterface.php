<?php

namespace Evilnet\QueueJobsBundle\QueueAdapter;

use Evilnet\QueueJobsBundle\QueueAdapter\View\QueueJobViewInterface;

interface QueueAdapterInterface
{
    public function push(string $serialized_dispatchable, string $queue) : void;
    public function pull(string $queue) : ?QueueJobViewInterface;
    public function isExist(string $identificator) : bool;
    public function delete(string $identificator) : void;
}