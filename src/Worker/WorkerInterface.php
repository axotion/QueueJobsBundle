<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:38
 */

namespace Evilnet\QueueJobsBundle\Worker;


use Evilnet\QueueJobsBundle\Dispatcher\DispatchableInterface;

interface WorkerInterface
{
    public function process() : bool;
    public function isNewJob(string $queue) : bool;
    public function getCurrentJob() : DispatchableInterface;
}