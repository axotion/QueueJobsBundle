<?php

namespace ddd\Command;

use ddd\Worker\WorkerInterface;
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
            ->addArgument('retry', InputArgument::REQUIRED, 'Retry')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Worker started on queue: '.$input->getArgument('queue'));

        while(true) {
            $this->worker->work($input->getArgument('queue'), (int)$input->getArgument('retry'));
            sleep(1);
        }
    }
}