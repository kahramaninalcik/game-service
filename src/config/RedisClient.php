<?php

require_once __DIR__ . '/TinyRedisClient.php';



class RedisClient
{

    public static function connect(): ?TinyRedisClient

    {
        try {

            return new TinyRedisClient(REDIS_HOST . ":" . REDIS_PORT);
        } catch (Exception $e) {
            $error = array();
            $error['error'] = 'Redis Connection Failed';
            $error['message'] = $e->getMessage();
            http_response_code(400);
            echo json_encode(new Response("ERROR", (string)time(), (object)$error));
            return null;
        }
    }

}
