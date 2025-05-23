<?php
require_once "Db.php";

class Hotel extends Db{

    private $dbcon ;

    public function __construct(){
        $this->dbcon = $this->connect();
    }
    #This method fetches all the hotels
    public function get_all_hotels(){
        try{
            $sql = "SELECT * FROM property";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $e){
            //echo $e->getMessage();
            return false;
        }
    }

    #retrieve details of a specified hotel
    public function get_one_hotel($id){
        try{
            $sql = "SELECT * FROM property WHERE property_id=?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        }catch(PDOException $e){
            //echo $e->getMessage();
            return false;
        }
    }

    #method to add a new hotel
    public function create_hotel($contact,$filename,$price,$name){
        try{
            $sql = "INSERT INTO property(property_contact,property_filename,property_price,property_name) VALUES(?,?,?,?)";
            $stmt= $this->dbcon->prepare($sql);
            $stmt->execute([$contact,$filename,$price,$name]);
            $id = $this->dbcon->lastInsertId();
            return $id;                     
        }
        catch(PDOException $e){
            //echo $e->getMessage();
            return false;
        }
    }

    #to update details of an hotel
    public function update_hotel($contact,$filename,$price,$name,$id){
        $sql = "UPDATE property SET property_contact=?,property_filename=?,property_price=?,property_name=? WHERE property_id=?";
        $stmt = $this->dbcon->prepare($sql);
        $res = $stmt->execute([$contact,$filename,$price,$name,$id]);
        return $res;#true or false if execute ran successfully
    }

}

?>