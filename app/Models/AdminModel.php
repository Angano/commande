<?php 
class AdminModel extends Database{

    public function __construct(){
        parent::__construct();
    }

    public function getProfilsAuthorizedToManagedDeliveries(){

        $sql = " SELECT * 
            FROM  mdpi8535_profil
            LEFT JOIN md_delivery_profil_authorized
            ON(md_delivery_profil_authorized.fk_profil=mdpi8535_profil.id) ";
        $query = $this->db->query($sql);

        return $query->fetchAll();
    }



    // Ajouter et activer un profil authorisé à gérer les commandes
    public function addProfilAuthorizedToManagedDeliveries($profil){

        $sql = " INSERT INTO md_delivery_profil_authorized(fk_profil, actif)
        values( :fk_profil, true)";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':fk_profil',$profil,PDO::PARAM_INT);

        $sql->execute();
    }

    public function getProfilAuthorizedToManagedDeliveries($fk_profil){
        $sql = " SELECT * 
            FROM md_delivery_profil_authorized
            WHERE fk_profil=:fk_profil ";

        $query= $this->db->prepare($sql);
        $query->bindValue(':fk_profil',$fk_profil,PDO::PARAM_INT);
        
        $query->execute();

        return $query->fetch();
    }

    // Mise à jour d'un profil authorisé à gérer les commandes
    public function updateProfilAuthorizedToManagedDeliveries($datas){

        $sql = " UPDATE md_delivery_profil_authorized 
            SET actif=:actif
            WHERE fk_profil=:fk_profil";

        $query = $this->db->prepare($sql);
        $query->bindValue(':actif',1, PDO::PARAM_INT);
        $query->bindValue(':fk_profil',$datas,PDO::PARAM_STR);

        $query->execute();

    }

    // Mise à 0 du champ actif
    public function resetAuthorizedToManagedDeliveries(){

        $sql = " UPDATE md_delivery_profil_authorized
            SET actif = '0' ";
        $query = $this->db->query($sql);
        $query->execute();
    }
}