<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 06.07.2018
 * Time: 00:24
 */

namespace Evilnet\ExampleJob;


use Evilnet\Dispatcher\DispatchableInterface;

class HelloWorld implements DispatchableInterface
{

    public $test_value;

    public function __construct()
    {
        $this->test_value = 'Hello from queue!';
    }

    public function execute(): void
    {
        echo $this->test_value;
    }
}