<?php

include_once __DIR__ . '/../config/TinyRedisClient.php';
include_once __DIR__ . '/../config/RedisClient.php';

class GameRepository

{

    private $redisClient;

    public function __construct()

    {
        $this->redisClient = RedisClient::connect();

    }

    public function addToBoard($score, $value): void
    {

        $test = $this->redisClient->zadd("score", $score, $value);

    }

    public function leaderBoard(): array
    {

        $result = $this->redisClient->zRevRange("score", 0, 100);

        return $result;

    }


}
