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

    /*
     * Interface For Insert the scores
     */
    public function addToBoard($score, $value): void
    {
        $this->redisClient->zadd("score", $score, $value);
    }

    /*
     * Interface For get sorted data
     */
    public function leaderBoard(): array
    {
        return $this->redisClient->zRevRange("score", 0, 100);

    }
}
