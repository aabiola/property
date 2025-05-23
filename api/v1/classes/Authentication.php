<?php
require_once "Db.php";
class Authentication extends Db{

    private $db;

    public function __construct(){
        $this->db = $this->connect();
    }

    public function verify_merchat($username,$password){
        $sql ="SELECT * FROM merchants WHERE merchant_username =? AND merchant_password =?";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([$username,$password]);
        $result = $stmt->rowCount();
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }
}

?>