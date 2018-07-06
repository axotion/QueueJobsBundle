<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 05.07.2018
 * Time: 23:19
 */

namespace QueueJobsBundle\Dispatcher;


interface DispatchableInterface
{
    public function execute() : void;
}