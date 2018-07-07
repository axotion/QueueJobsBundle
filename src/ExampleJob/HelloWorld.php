<?php

namespace Evilnet\QueueJobsBundle\ExampleJob;

use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;

class HelloWorld implements DispatchableInterface
{

    public $test_value;

    public function __construct()
    {
        $this->test_value = 'Hello from queue!';
    }

    public function execute(): bool
    {
        echo $this->test_value."\n";
        return true;
    }
}