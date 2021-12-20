<?php


include_once __DIR__ . '/../config/TinyRedisClient.php';
include_once __DIR__ . '/../config/RedisClient.php';

class UserRepository

{

    private $redisClient;

    public function __construct()

    {
        $this->redisClient = RedisClient::connect();
    }

    public function checkUserName(string $username): bool
    {
        return $result = $this->redisClient->hexists("password",$username);
    }

    public function checkUserId(string $id): bool
    {
        return $this->redisClient->hexists("user",$id);

    }

    public function getPassword(string $username): ?string
    {
        return $this->redisClient->hget("password", $username);

    }

    public function getUserName($id): ?string
    {
        return $this->redisClient->hget("user", $id);

    }

    public function getId($username): ?string
    {
        try {
            $array = $this->redisClient->hvals("user");
            $arrayKeys = $this->redisClient->hkeys("user");
            return $arrayKeys[array_search($username,$array)];
        }catch (Exception $exception){
            return "not_found";
        }


    }

    public function saveUser(object $user): ?object
    {


        $this->redisClient->hsetnx("user", $user->getId(), $user->getUsername());
        $this->redisClient->hsetnx("password", $user->getUsername(), $user->getPassword());

        return $user;

    }

    public function getAllUsers(): array
    {

        $result = $this->redisClient->hgetAll("user");
        return $result;
    }
}
