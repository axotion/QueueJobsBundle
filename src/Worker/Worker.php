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
use Evilnet\QueueJobsBundle\QueueAdapter\View\QueueJobViewInterface;
use Evilnet\QueueJobsBundle\Worker\Unserializers\UnserializeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class Worker implements WorkerInterface
{
    protected $adapter;
    protected $unserializer;
    protected $eventDispatcher;
    protected $currentJob;

    public function __construct(QueueAdapterInterface $adapter, UnserializeInterface $unserializer, EventDispatcherInterface $eventDispatcher)
    {
        $this->adapter = $adapter;
        $this->unserializer = $unserializer;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function process() : bool
    {
        $result = $this->currentJob->execute();

        if($result === false) {
            $this->eventDispatcher->dispatch('job.failed', new GenericEvent($this->currentJob));
        }

        return $result;
    }

    public function getCurrentJob(): DispatchableInterface
    {
        if($this->currentJob === null) {
            throw new \LogicException('Job must be initialized at first');
        }

        return $this->currentJob;
    }

    public function isNewJob(string $queue): bool
    {
        $queueJobView = $this->adapter->pull($queue);

        if(!$queueJobView instanceof QueueJobViewInterface) {
            return false;
        }

        $this->currentJob = $this->unserializer->unserialize($queueJobView->getSerializedJob());

        // Check if time is ok etc

        if($this->adapter->isExist($queueJobView->getIdentificator())) {
            $this->adapter->delete($queueJobView->getIdentificator());
            return true;
        }

        return false;
    }
}