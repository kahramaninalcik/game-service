<?php

require_once __DIR__ . '/../service/UserService.php';
require_once __DIR__ . '/../util/Response.php';
require_once __DIR__ . '/../config/config.php';


class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /*
     * For Signup
     */
    public function register(object $data): void
    {
        $result = $this->userService->register($data);

        if (!is_null($result))
            Response::returnSuccess($result);
        else {
            Response::throwError(500, REGISTER_FAILED, REGISTER_FAILED);
        }
    }

    /*
     * For Signin
     */
    public function login(object $data): void
    {
        $result = $this->userService->login($data);
        if (!is_null($result))
            Response::returnSuccess($result);
        else {
            Response::throwError(500, LOGIN_FAILED, LOGIN_FAILED);
        }
    }
}
