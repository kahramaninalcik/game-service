<?php

require __DIR__ . '/../repository/GameRepository.php';

class GameService
{

    private $gameRepository;
    private $userRepository;

    function __construct()
    {

        $this->gameRepository = new GameRepository();
        $this->userRepository = new UserRepository();

    }

    public function endGame(object $data): ?object
    {

        if (empty($data->players))
            return null;


        $arrayDataUsers = array();
        $arrayDataUsersAll = array();
        foreach ($data->players as $item) {
            if (!empty($item) && !empty($item->id) && !empty($item->score) && $this->userRepository->checkUserId($item->id)) {
                $userName = $this->userRepository->getUserName($item->id);
                $this->gameRepository->addToBoard($item->score, $item->id);
                $arrayDataUsers["score"] = $item->score;
                $arrayDataUsers["username"] = $userName;
                $arrayDataUsers["id"] = $item->id;

                $arrayDataUsersAll[] = $arrayDataUsers;

            } else
                continue;
        }


        return (object)$arrayDataUsersAll;

    }


    public function leaderBoard(): ?object
    {

        $arrayAll = array();
        foreach ($this->gameRepository->leaderBoard() as $key => $item) {
            $array = array();
            $array['rank'] = (int)$key + 1;
            $array['id'] = $item;
            $array['username'] = $this->userRepository->getUserName($item);

            $arrayAll[] = $array;

        }
        return (object) $arrayAll;


    }
}
