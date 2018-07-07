# QueueJobsBundle

Jobs system like in Laravel now in Symfony 3.x!

## About

Are you tired of fancy rabbitmq configurations? Would you like such a simplicity of work as in Laravel? That's what this package is for! I created it for the ecommerce project to process simple tasks, but it may also be useful to you

## Install

```
composer require evilnet/queue-jobs-bundle
```

### Post-Install

Enable package in your AppKernel.php


```
 $bundles = [
                new Evilnet\QueueJobsBundle\QueueJobsBundle(),
            ];
```

And add these parameters to your parameters.yml

```
queue_redis_ip: 127.0.0.1 (usually)
queue_redis_port: 6379 (usually)
default_queue_name: default
```

And that's it! You can test it by running two commands in terminal

```
bin/console worker:start default
```

And then demo dispatcher

```
bin/console dispatch:test
```

You should see Hello World in terminal with worker

## Example code


Example Job Class
```
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
```


Example of dispatch job
```
<?php

namespace Evilnet\QueueJobsBundle\Command;

use Evilnet\QueueJobsBundle\Dispatcher\DispatcherInterface;
use Evilnet\QueueJobsBundle\ExampleJob\HelloWorld;

class ExampleService
{
    protected $dispatcher;

    public function __construct(DispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function test()
    {
        $hello_world_job = new HelloWorld();
        $this->dispatcher->dispatch($hello_world_job, 'default'); //Queue name. You can use configured parameter here
    }
   
}
```

And to be honest... That's all!


#TODO BY PRIORITY

- Tests
- Better configuration for Bundle where you can choose adapter etc.
- Timeout for jobs. Execute after 15 minutes etc.
- More adapters. For now only redis is available

### Tests

Coming soon!

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

