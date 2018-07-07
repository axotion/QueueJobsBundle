<?php

namespace  Evilnet\QueueJobsBundle\Dispatcher;

interface DispatchableInterface
{
    public function execute() : bool;
}