<?php

namespace Evilnet\QueueJobsBundle\Command;

use Evilnet\QueueJobsBundle\Worker\WorkerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerCommand extends Command
{

    protected $worker;

    public function __construct(?string $name = null, WorkerInterface $worker)
    {
        parent::__construct($name);
        $this->worker = $worker;
    }

    protected function configure()
    {
        $this
            ->setName('worker:start')
            ->setDescription('Start new instance of worker')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Worker started on queue: '.$input->getArgument('queue'));

        while(true) {
            if($this->worker->isNewJob($input->getArgument('queue'))){
                $output->writeln("Process: ".get_class($this->worker->getCurrentJob()));
                if($this->worker->process()) {
                    $output->writeln("Processed: ".get_class($this->worker->getCurrentJob()));
                } else{
                    $output->writeln("Failed to procedd: ".get_class($this->worker->getCurrentJob()));
                }
            }
            sleep(1);
        }
    }
}