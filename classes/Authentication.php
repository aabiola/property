<?php
    require_once "Db.php";

    class Authentication extends Db{

        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }
        public function verify_user($username, $password){
            $sql = "SELECT * FROM merchants where merchant_username = ? AND merchant_password=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$username, $password]);
            $result = $stmt->rowCount();
            if($result > 0){
                return true;
            }else{
                return false;
            }
        }
    }

    // $auth1 = new Authentication;
    // var_dump($auth1->verify_user("bookworm", "cohort27"));




?>