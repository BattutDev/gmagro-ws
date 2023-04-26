<?php

namespace entities;

class UserEntity
{
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $actif;
    private $role_code;
    private $site_uai;
    private $cle;

    function __construct() {

    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole_code() {
        return $this->role_code;
    }

    function isActif() {
        return $this->actif == 1;
    }

    function getSite_uai() {
        return $this->site_uai;
    }

    function getCle() {
        return $this->cle;
    }

    public function __toString() {
        return $this->nom . " " . $this->prenom;
    }

    public function toJson() {
        return [
            'id' => $this->getId(),
            'mail' => $this->getMail(),
            'prenom' => $this->getPrenom(),
            'nom' => $this->getNom(),
            'actif' => $this->isActif(),
            'role_code' => $this->getRole_code(),
            'site_uai' => $this->getSite_uai()
        ];
    }
}