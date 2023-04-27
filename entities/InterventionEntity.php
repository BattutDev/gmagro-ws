<?php

namespace entities;

use repositories\UserRepository;

class InterventionEntity {

    public function __construct() {

    }

    private $id;
    private $dh_debut;
    private $dh_fin;
    private $commentaire;
    private $temps_arret;
    private $changement_organe;
    private $perte;
    private $dh_creation;
    private $dh_derniere_maj;
    private $intervenant_id;
    private $activite_code;
    private $machine_code;
    private $cause_defaut_code;
    private $cause_objet_code;
    private $symptome_defaut_code;
    private $symptome_objet_code;


    public function getId() {
        return $this->id;
    }

    public function getCommentaire(){
        return $this->commentaire;
    }
    public function getDh_debut() {
        return $this->dh_debut;
    }

    public function getDh_fin() {
        return $this->dh_fin;
    }

    public function getTemps_arret() {
        return $this->temps_arret;
    }

    public function getChangement_organe() {
        return $this->changement_organe;
    }

    public function getPerte() {
        return $this->perte;
    }

    public function getDh_creation() {
        return $this->dh_creation;
    }

    public function getDh_derniere_maj() {
        return $this->dh_derniere_maj;
    }

    public function getIntervenant_id() {
        return $this->intervenant_id;
    }

    public function getActivite_code() {
        return $this->activite_code;
    }

    public function getMachine_code() {
        return $this->machine_code;
    }

    public function getCause_defaut_code() {
        return $this->cause_defaut_code;
    }

    public function getCause_objet_code() {
        return $this->cause_objet_code;
    }

    public function getSymptome_defaut_code() {
        return $this->symptome_defaut_code;
    }

    public function getSymptome_objet_code() {
        return $this->symptome_objet_code;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "dh_debut" => $this->getDh_debut(),
            "dh_fin" => $this->getDh_fin(),
            "commentaire" => $this->getCommentaire(),
            "temps_arret" => $this->getTemps_arret(),
            "changement_organe" => $this->getChangement_organe(),
            "perte" => $this->getPerte(),
            "dh_creation" => $this->getDh_creation(),
            "dh_derniere_maj" => $this->getDh_derniere_maj(),
            "intervenant" => UserRepository::getById($this->getIntervenant_id())->toArray(),
            "activite_code" => $this->getActivite_code(),
            "machine_code" => $this->getMachine_code(),
            "cause_defaut_code" => $this->getCause_defaut_code(),
            "cause_objet_code" => $this->getCause_objet_code(),
            "symptome_defaut_code" => $this->getSymptome_defaut_code(),
            "symptome_objet_code" => $this->getSymptome_objet_code(),
        ];
    }

    /*
    public function getActivite() {
        return \repositories\ActiviteRepository::getActiviteById($this->activite_code);
    }
    */

}
