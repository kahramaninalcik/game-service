<?php


require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../domain/User.php';
require_once __DIR__ . '/../config/config.php';


class UserService
{
    private $userRepository;

    function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /*
     * Action of Signup
     */
    public function register(object $data): ?object
    {
        if (empty(trim($data->username)) || empty(trim($data->password)))
            return null;
        if ($this->checkUsernameExist($data->username))
            return null;
        $user = new User();
        $user->setId(time());
        $user->setPassword($this->encrypt($data->password));
        $user->setUsername($data->username);

        return $this->userRepository->saveUser($user);
    }

    /*
     * Check Username is existed
     */
    public function checkUsernameExist(string $username): bool
    {
        return $this->userRepository->checkUserName($username);
    }

    /*
     * Action of Login
     */
    public function login(object $data): ?object
    {
        if (empty(trim($data->username)) || empty(trim($data->password)))
            return null;

        if (!$this->checkUsernameExist($data->username))
            return null;

        $password = $this->userRepository->getPassword($data->username);
        if (!empty($password)  && $data->password == $this->decrypt($password)) {
            $response['id']= $this->userRepository->getId($data->username);
            $response['username']= $data->username;
            return (object) $response;
        } else
            return null;
    }

    /*
     * Password Encrypt
     */
    protected function encrypt(string $pass): string
    {
        return openssl_encrypt($pass, CIP, ENCRYPT_KEY, 0, IV);
    }

    /*
     * Password Decrypt
     */
    protected function decrypt($encrypted): string
    {
        return openssl_decrypt($encrypted, CIP, ENCRYPT_KEY, 0, IV);
    }
}
