<?php

namespace controllers;

use entities\UserEntity;
use repositories\UserRepository;

abstract class BaseController
{
    public static $default_action = 'main';


    public function __construct(string $action)
    {
        $this->execute($action);
    }

    public static function error(string $message, int $code): void
    {
        BaseController::response([
            'message' => $message
        ], $code);
    }

    public static function response(array $body, int $code)
    {
        http_response_code($code);
        echo json_encode($body);
    }

    abstract function execute(string $action);

    protected function authFailed(): void
    {
        $this->error("Authentication failed, retry", 401);
    }

    protected function isLogged(): bool {
        return isset($_SESSION['user']);
    }
}