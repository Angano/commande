<?php
class UserModel extends Database{
   
    public function __construct(){
        parent::__construct();
    }
    

    public function getCurrentUser(){

        $sql = " SELECT llx_user.rowid, job, civility, lastname, firstname, login, llx_user.email, llx_user.address, llx_user.zip, llx_user.town, 
        llx_societe.nom, llx_societe.nom,md_delivery_profil_authorized.actif
        FROM llx_user
        LEFT JOIN mdpi8535_profil ON(mdpi8535_profil.id=llx_user.job)
        LEFT JOIN llx_societe ON(llx_societe.rowid=llx_user.fk_soc)
        LEFT JOIN md_delivery_profil_authorized ON(md_delivery_profil_authorized.fk_profil=mdpi8535_profil.id)
        WHERE llx_user.rowid=:rowid";

        
        $query = $this->db->prepare($sql);
        $query->bindValue(':rowid',$_SESSION['user_id'],PDO::PARAM_INT);
        $query->execute();

        return $query->fetch();

    

    }
}