<?php

namespace  Evilnet\QueueJobsBundle\Dispatcher;

interface DispatchableInterface
{
    public function execute() : void;
    public function getName() : string;
}