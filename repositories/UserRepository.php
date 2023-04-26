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
}