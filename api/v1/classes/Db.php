<?php
require_once "config.php";
class Db{
    private $dbhost = DBHOST;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbname = DBNAME;
    

    protected function connect(){
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;";
        $option=[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try{
            $pdo = new PDO($dsn,$this->dbuser,$this->dbpass,$option);
            return $pdo;
        }catch(PDOException $e){
            //echo $e->getMessage(); 
            return false ;
        }
    }
}


?>