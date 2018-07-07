<?php

namespace Evilnet\QueueJobsBundle\QueueAdapter\View;

class QueueJobView implements QueueJobViewInterface
{
    protected $identificator;
    protected $serialized_job;

    public function __construct(string $identificator, string $serialized_job)
    {
        $this->identificator = $identificator;
        $this->serialized_job = $serialized_job;
    }

    /**
     * @return string
     */
    public function getIdentificator(): string
    {
        return $this->identificator;
    }

    /**
     * @return string
     */
    public function getSerializedJob(): string
    {
        return $this->serialized_job;
    }
}