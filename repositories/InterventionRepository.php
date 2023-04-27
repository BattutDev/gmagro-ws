<?php

namespace repositories;

class InterventionRepository {

    public static function getAllIntervention() {
        $sql = "SELECT inter.id, date_format(dh_debut,'%d/%m/%Y') as dh_debut, dh_fin, commentaire, temps_arret, changement_organe, perte, dh_creation, dh_derniere_maj, intervenant_id, activite_code, machine_code, cause_defaut_code, cause_objet_code, symptome_defaut_code, symptome_objet_code "
            . "FROM intervention as inter "
            . "inner join intervenant as i on i.id = inter.intervenant_id "
            . "where site_uai=? order by inter.dh_debut desc";
        $stmt = PdoBD::getInstance()->getMonPdo()->prepare($sql);
        $stmt->bindValue(1, unserialize($_SESSION['user'])['site_uai'], \PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\entities\InterventionEntity');
        return $stmt->fetchAll();
    }

}
