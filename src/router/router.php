<?php


require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../controller/GameController.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../util/Response.php';

class Router
{
    private $supportedHttpMethods = array(GET, POST);
    private $supportedPaths = array(
        LOGIN, REGISTER, END_GAME, LEADER_BOARD
    );
    private $activeMethod;
    private $userController;
    private $gameController;

    function __construct()
    {
        if (!$this->checkHttpType())
            Response::throwError(400, HTTP_ERROR, HTTP_ERROR_MESSAGE);
        if (!$this->checkPath()) {
            Response::throwError(400, PATH_ERROR, PATH_ERROR_MESSAGE);
            exit();
        }

        $this->userController = new UserController();
        $this->gameController = new GameController();
    }

    /*
     * Check Http Method
     */
    private function checkHttpType(): bool
    {
        if (in_array($_SERVER['REQUEST_METHOD'], $this->supportedHttpMethods)) {
            $this->activeMethod = $_SERVER['REQUEST_METHOD'];
            return true;
        } else
            return false;
    }

    /*
     * Check Slug
     */
    private function checkPath(): bool
    {
        if (in_array($_SERVER['REQUEST_URI'], $this->supportedPaths))
            return true;
        else
            return false;
    }

    public function processStart(): void
    {
        if ($this->activeMethod == GET) {
            $this->getProcess();
        } else if ($this->activeMethod == POST) {
            $this->postProcess($_SERVER['REQUEST_URI']);
        }
    }

    private function getProcess(): void
    {
        $this->gameController->leaderBoard();
    }

    private function postProcess(string $slug): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if ($slug == LOGIN) {
            $this->userController->login($data);
        } else if ($slug == REGISTER) {
            $this->userController->register($data);
        } else if ($slug == END_GAME) {
            $this->gameController->endGame($data);
        }
    }
}
