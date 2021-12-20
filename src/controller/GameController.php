<?php

require_once __DIR__ . '/../service/GameService.php';
require_once __DIR__ . '/../util/Response.php';
require_once __DIR__ . '/../config/config.php';

class GameController
{

    private $gameService;

    public function __construct()
    {
        $this->gameService = new GameService();
    }

    /*
     * For Enter Score
     */
    public function endGame(object $data): void

    {
        $result = $this->gameService->endGame($data);
        if (!empty($result))
            Response::returnSuccess($result);
        else
            Response::throwError(500, API_FAILED, API_FAILED);
    }

    /*
     * Get Sorted Leader Board
     */
    public function leaderBoard(): void

    {
        $result = $this->gameService->leaderBoard();
        if (!empty($result))
            Response::returnSuccess($result);
        else {
            Response::throwError(500, API_FAILED, API_FAILED);
        }
    }
}
