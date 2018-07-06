<?php
/**
 * Created by PhpStorm.
 * User: kamilfronczak
 * Date: 06.07.2018
 * Time: 02:57
 */

namespace ddd\Command;


use ddd\Dispatcher\DispatcherInterface;
use ddd\ExampleJob\HelloWorld;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DispatchTestCommand extends Command
{

    protected $dispatcher;

    public function __construct(?string $name = null, DispatcherInterface $dispatcher)
    {
        parent::__construct($name);
        $this->dispatcher = $dispatcher;
    }

    protected function configure()
    {
        $this
            ->setName('dispatch:test')
            ->setDescription('Show example of dispatch');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hello_world_job = new HelloWorld();

        while(true) {
            $this->dispatcher->dispatch($hello_world_job, 'default');
            $output->writeln('Dispatched');
            sleep(5);
        }
    }
}