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
                if ($this->isLogged()) {
                    http_response_code(200);
                    echo json_encode(unserialize($_SESSION['user']));
                } else BaseController::error('Non connecté', 401);

        break;
            case 'login':
                    $mail = filter_input(INPUT_GET, 'mail', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);

                    if ($mail && $password) {
                        $user = UserRepository::auth($mail, $password);
                        if ($user) {
                            $_SESSION['user'] = serialize($user->toJson());
                            echo json_encode($user->toJson());
                        } else $this->authFailed();
                    } else BaseController::error('Champs manquant', 401);
                break;
            case 'logout':
                if ($this->isLogged()) {
                    session_destroy();
                    BaseController::response([
                        'message' => 'Successfully logout'
                    ], 200);
                } else BaseController::error('Non connecté', 401);
                break;
        }
    }
}