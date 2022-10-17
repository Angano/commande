<?php
    class CommandeModel extends Database{
       
        public function __construct(){
            parent::__construct();
          
         
        }
        public function getCommandes($datas = ['limit'=>'30','offset'=>'0']){
            if(!isset($datas['limit'])){
                $datas = ['limit'=>'30','offset'=>'0'];
            }
            $sql =  " SELECT DISTINCT llx_commande.rowid, llx_commande.fk_soc ,llx_societe.rowid, llx_societe.nom,llx_societe.address, 
            llx_societe.zip, llx_societe.town,  llx_commande.rowid, llx_commande.ref, llx_commande.fk_statut, todo, 
            md_todo_with_delivery.id as todoId, 
            cityCode, nameCity, postCode, latitude, longitude
            FROM llx_commande
            INNER join llx_societe on(llx_commande.fk_soc=llx_societe.rowid)
            LEFT JOIN md_todo_with_delivery ON(llx_commande.rowid=md_todo_with_delivery.fk_command)
            LEFT JOIN md_gps_soc ON(md_gps_soc.fk_soc=llx_societe.rowid)";

            if(isset($datas['soc']) && is_numeric($datas['soc'])){
                            $sql = $sql . ' WHERE llx_commande.fk_soc=:soc ';
                            $soc = intval($datas['soc']);
                        }

            $sql = $sql. " LIMIT :limit OFFSET :offset "; 
            
           
            $query = $this->db->prepare($sql);
            $query->bindValue(':limit',$datas['limit'],PDO::PARAM_INT);
            $query->bindValue(':offset',$datas['offset'],PDO::PARAM_INT);
        
            if(isset($datas['soc']) && is_numeric($datas['soc'])){
                $query->bindValue(':soc',$soc,PDO::PARAM_INT);
             
            }
            $query->execute();
            $resultats = $query->fetchAll();

            return $resultats;
        }

        public function commandeById($id){

            $sql = " SELECT llx_commande.rowid, llx_commande.fk_soc ,llx_societe.rowid, llx_societe.nom,llx_societe.address, 
            llx_societe.zip, llx_societe.town,  llx_commande.rowid, llx_commande.ref, llx_commande.fk_statut , md_todo_with_delivery.todo , 
            md_todo_with_delivery.id as todoId, latitude, longitude
            FROM llx_commande
            INNER join llx_societe on(llx_commande.fk_soc=llx_societe.rowid)
            LEFT JOIN md_todo_with_delivery ON(llx_commande.rowid=md_todo_with_delivery.fk_command)
            LEFT JOIN md_gps_soc ON(md_gps_soc.fk_soc=llx_societe.rowid)
            WHERE llx_commande.rowid=:id";

            $query = $this->db->prepare($sql);
            $query->bindValue(':id',$id,PDO::PARAM_INT);
            $query->execute();
           
            $resultat = $query->fetch();

            return $resultat;
        }

        public function commandeBySoc($soc){
            $sql = " SELECT llx_commande.rowid, fk_soc ,llx_societe.rowid, llx_societe.nom,llx_societe.address, 
            llx_societe.zip, llx_societe.town,  llx_commande.rowid, llx_commande.ref, llx_commande.fk_statut , todo , md_todo_with_delivery.id as todoId
            FROM llx_commande
            INNER join llx_societe on(llx_commande.fk_soc=llx_societe.rowid)
            LEFT JOIN md_todo_with_delivery ON(llx_commande.rowid=md_todo_with_delivery.fk_command)
            WHERE llx_commande.fk_soc=:soc ";

            $query = $this->db->prepare($sql);
            $query->bindValue(':soc',$soc,PDO::PARAM_INT);
            $query->execute();

            return $query->fetchAll();
        }
        
        public function getSearchSocieteByNom($soc){
       
            $sql = " SELECT DISTINCT llx_societe.rowid, llx_societe.nom,llx_societe.address, 
            llx_societe.zip, llx_societe.town
            FROM llx_commande
            LEFT JOIN llx_societe ON(llx_societe.rowid=llx_commande.fk_soc)
            WHERE llx_societe.nom like :nom
            LIMIT 10";

            $query = $this->db->prepare($sql);
            $query->bindValue(':nom','%'.$soc.'%');
            $query->execute();
           
            $resultat = $query->fetchAll();

            return $resultat;
        }


        public function updateStatusCommande($datas){

            $sql = "UPDATE llx_commande 
                    SET
                        fk_statut=:fk_statut
                    WHERE rowid=:rowid";

            $query = $this->db->prepare($sql);
            $query->bindValue(':fk_statut',$datas['fk_statut'],PDO::PARAM_INT);
            $query->bindValue(':rowid',$datas['rowid'],PDO::PARAM_INT);

            $query->execute();

        }

        public function countCommande($data=''){

            $sql = " SELECT count(rowid) as count FROM llx_commande ";

            if(isset($data) && is_numeric($data)){
                $soc = intval($data);
                $sql = $sql." WHERE fk_soc=:soc ";
            }
            $query = $this->db->prepare($sql);
          

            if(isset($soc) && is_numeric($soc)){
                $query->bindValue(':soc',$soc,PDO::PARAM_INT);
            }

            $query->execute();

            return $query->fetch();
        }


        public function addTodo($datas){
            
            $sql = "INSERT INTO md_todo_with_delivery
            (todo, fk_command, fk_user, created_at)
            VALUES (:todo, :fk_command, :fk_user, :created_at)";

            $query = $this->db->prepare($sql);
            $query->bindValue(':todo', $datas['todo'], PDO::PARAM_STR);
            $query->bindValue(':fk_command', $datas['fk_command'], PDO::PARAM_STR);
            $query->bindValue(':fk_user', $datas['fk_user'], PDO::PARAM_STR);
            $query->bindValue(':created_at', $datas['created_at'], PDO::PARAM_STR);

            $query->execute();


        }

        public function updateTodo($datas){
            
            $sql = "UPDATE md_todo_with_delivery
            SET
                todo=:todo,
                fk_command=:fk_command,
                fk_user=:fk_user,
                created_at=:created_at
                
            WHERE id=:todoId";

            $query = $this->db->prepare($sql);
            $query->bindValue(':todoId', $datas['todoId'], PDO::PARAM_STR);
            $query->bindValue(':todo', $datas['todo'], PDO::PARAM_STR);
            $query->bindValue(':fk_command', $datas['fk_command'], PDO::PARAM_STR);
            $query->bindValue(':fk_user', $datas['fk_user'], PDO::PARAM_STR);
            $query->bindValue(':created_at', $datas['created_at'], PDO::PARAM_STR);

            $query->execute();
        }
}