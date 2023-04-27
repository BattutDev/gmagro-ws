<?php

namespace controllers;

use repositories\UserRepository;

class AuthController extends BaseController
{
    public static $default_action = 'login';

    function execute(string $action)
    {
        switch ($action) {
            case 'me':
                $this->run_me();
                break;
            case 'login':
                $this->run_login();
                break;
            case 'logout':
                $this->run_logout();
                break;
        }
    }

    private function run_login() {
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($mail && $password) {
            $user = UserRepository::auth($mail, $password);
            if ($user) {
                $_SESSION['user'] = serialize($user->toArray());
                http_response_code(200);
                echo json_encode($user->toArray());
            } else $this->authFailed();
        } else BaseController::error('Champs manquant', 401);
    }

    private function run_logout() {
        if ($this->isLogged()) {
            session_destroy();
            BaseController::response([
                'message' => 'Successfully logout'
            ], 200);
        } else BaseController::error('Non connecté', 401);
    }

    private function run_me() {
        if ($this->isLogged()) {
            http_response_code(200);
            echo json_encode(unserialize($_SESSION['user']));
        } else BaseController::error('Non connecté', 401);
    }

}