<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:41
 */

namespace Evilnet\QueueJobsBundle\Worker;

use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;
use Evilnet\QueueJobsBundle\QueueAdapter\QueueAdapterInterface;
use Evilnet\QueueJobsBundle\Worker\Unserializers\UnserializeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class Worker implements WorkerInterface
{
    protected $driver;
    protected $unserializer;
    protected $eventDispatcher;

    public function __construct(QueueAdapterInterface $driver, UnserializeInterface $unserializer, EventDispatcherInterface $eventDispatcher)
    {
        $this->driver = $driver;
        $this->unserializer = $unserializer;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function work(string $queue = 'default', int $retry = 1, $retry_serialized_job = null) : void
    {
        $serialized_job = $this->driver->pop($queue);

        /*
         *  Probably not ready yet
         */

        if($serialized_job === null) {
            return;
        }

        $unserialized_job = $this->unserializer->unserialize($serialized_job);

        while ($retry > 0) {
            $is_succed = $this->execute($unserialized_job, $retry, $serialized_job, $queue);
            if($is_succed) {
                break;
            }
            $retry--;
        }

        $this->eventDispatcher->dispatch('job.failed', new GenericEvent($unserialized_job));
    }

    protected function execute(DispatchableInterface $dispatchable, int $retry, string $serialized_job, string $queue) : bool
    {
        try {
            echo "Proccessing: ".$dispatchable->getName()." \n";
            $dispatchable->execute();
            return true;
            // TODO: Universal Exception for Jobs
        } catch (\ErrorException $errorException) {
            echo "Job failed... I will try again. Error message: ".$errorException->getMessage()." \n";
        }
    }

}