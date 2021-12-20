<?php

class Response
{
    public  $status;
    public  $timestamp;
    public  $result;

    /**
     * @param string $status
     * @param string $timestamp
     * @param object $result
     */
    public function __construct(string $status, string $timestamp, object $result)
    {
        $this->status = $status;
        $this->timestamp = $timestamp;
        $this->result = $result;

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return object
     */
    public function getResult(): object
    {
        return $this->result;
    }

    /**
     * @param object $result
     */
    public function setResult(object $result): void
    {
        $this->result = $result;
    }

    static function throwError($errorCode,$title,$message):void{
        $error = array();
        $error['error']=$title;
        $error['message']=$message;
        http_response_code((int)$errorCode);
        echo json_encode(new Response("ERROR", (string)time(),(object)$error));

    }

    static function returnSuccess(object $result):void{
        http_response_code(200);
        echo json_encode(new Response("SUCCEES", (string)time(),$result));

    }




}
