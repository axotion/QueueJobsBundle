<?php

namespace Evilnet\QueueJobsBundle\QueueAdapter;

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

    public function push(string $serialized_dispatchable, string $queue = 'default'): void
    {
        $this->client->set($queue.':'.random_int(0,999999999999), $serialized_dispatchable);
    }

    public function pop(string $queue = 'default'): ?string
    {
        $redis_key = null;
        foreach (new Iterator\Keyspace($this->client, $queue.':*') as $key) {
            $redis_key = $key;
            break;
        }

        $serialized_job =  $this->client->get($redis_key);
        $this->client->del($redis_key);

        return $serialized_job;
    }
}