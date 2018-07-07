<?php

namespace Evilnet\QueueJobsBundle\QueueAdapter;

use Evilnet\QueueJobsBundle\QueueAdapter\View\QueueJobView;
use Evilnet\QueueJobsBundle\QueueAdapter\View\QueueJobViewInterface;
use Predis\Collection\Iterator;
use Predis\Client;

class RedisAdapter implements QueueAdapterInterface
{
    protected $client;

    public function __construct(string $ip, int $port)
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => $ip,
            'port'   => $port,
        ]);

    }

    public function push(string $serialized_dispatchable, string $queue): void
    {
        $this->client->set($queue.':'.uniqid('', true), $serialized_dispatchable);
    }

    public function pull(string $queue): ?QueueJobViewInterface
    {
        $redis_key = null;
        foreach (new Iterator\Keyspace($this->client, $queue.':*') as $key) {
            $redis_key = $key;
            break;
        }

        if($redis_key === null) {
            return null;
        }

        $serialized_job = $this->client->get($redis_key);
        return new QueueJobView($redis_key, $serialized_job);
    }

    public function isExist(string $identificator): bool
    {
        $result = $this->client->get($identificator);
        return $result !== "" || $result !== null ? true : false;
    }

    public function delete(string $identificator): void
    {
        $this->client->del($identificator);
    }
}