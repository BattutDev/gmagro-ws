<?php

namespace controllers;

use entities\Intervention;
use entities\InterventionEntity;
use repositories\InterventionRepository;

class InterventionController extends BaseController
{
    public static $default_action = 'getall';

    function execute(string $action)
    {
        switch ($action) {
            case 'getall':
                $this->run_getall();
                break;
        }
    }

    private function run_getall() {
        if ($this->isLogged()) {

            $interventions = InterventionRepository::getAllIntervention();

            $mapped_interventions = array_map([$this, 'toArray'], $interventions);

            http_response_code(200);
            echo json_encode($mapped_interventions);
        } else BaseController::error('Non connecté', 401);
    }

    private function toArray(InterventionEntity $intervention): array
    {
        return $intervention->toArray();
    }
}