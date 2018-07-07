<?php

namespace Evilnet\QueueJobsBundle\QueueAdapter\View;


interface QueueJobViewInterface
{
    /**
     * @return string
     */
    public function getIdentificator(): ?string;

    /**
     * @return string
     */
    public function getSerializedJob(): ?string;
}