<?php
class Database{
    private $dbUser = DB_USER;
    private $dbName = DB_NAME;
    private $dbHost = DB_HOST;
    private $dbPort = DB_PORT;
    private $dbPassword = DB_PASSWORD;
    public $db;

    public function __construct(){
     
    
        $dns = 'mysql:host='.DB_HOST.';port='.$this->dbPort.';dbname='.$this->dbName.';charset=utf8mb4';
        $options = array(
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
        );


        try{
            $this->db = new PDO($dns,$this->dbUser, $this->dbPassword, $options);
           
        }
        catch(PDOEXECPTION $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

   

  
}