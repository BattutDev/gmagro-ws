<?php

namespace repositories;

use entities\UserEntity;

class UserRepository
{
    /**
     *
     * @param string $mail
     * @param string $password
     * @return UserEntity|null
     */
    public static function auth(string $mail, string $password) {
        $sql = "SELECT id,nom,prenom,mail,actif,role_code,site_uai FROM intervenant where mail=:mail and `password`=md5(:password);";
        $stmt = PdoBD::getInstance()->getMonPdo()->prepare($sql);
        $stmt->bindValue(":mail", $mail);
        $stmt->bindValue(":password", $password);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\entities\UserEntity');
        return $stmt->fetch();
    }

    public static function getById($id) {
        $sql = "SELECT id,nom,prenom,mail,actif,role_code,site_uai FROM intervenant where id=? and site_uai=?;";
        $stmt = PdoBD::getInstance()->getMonPdo()->prepare($sql);
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->bindValue(2, unserialize($_SESSION['user'])['site_uai']);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\entities\UserEntity');
        return $stmt->fetch();
    }
}