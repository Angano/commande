<?php
class GpsSocModel extends Database{

    public function getSocietes(){

        $sql = "SELECT rowid, zip, town, nom, id,latitude, longitude, cityCode, nameCity, postCode
        FROM llx_societe
        LEFT JOIN md_gps_soc ON(rowid=fk_soc)";
        $query = $this->db->query($sql);

        return $query->fetchAll();
    }

    public function addGpsSoc($datas){
        $sql = "INSERT INTO md_gps_soc (fk_soc, latitude, longitude, cityCode,nameCity, postCode)
                VALUES (:fk_soc, :latitude, :longitude, :cityCode, :nameCity, :postCode)";

        $query = $this->db->prepare($sql);

        $query->bindValue(':fk_soc',$datas['fk_soc'],PDO::PARAM_INT);
        $query->bindValue(':latitude',strval($datas['latitude']),PDO::PARAM_STR);
        $query->bindValue(':longitude',strval($datas['longitude']),PDO::PARAM_STR);
        $query->bindValue(':cityCode',$datas['cityCode'],PDO::PARAM_INT);
        $query->bindValue(':nameCity',$datas['city'],PDO::PARAM_STR);
        $query->bindValue(':postCode',$datas['postCode'],PDO::PARAM_INT);

        $query->execute();
        

}
}