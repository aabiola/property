<?php
    error_reporting(E_ALL);
    require_once "Db.php";


    class Hotel extends Db{

        private $dbconn;

        public function __construct()
        {
            $this->dbconn = $this->connect();
        }

        //this method fetches all hotels
        public function list_all_hotels(){
            $sql = "SELECT * FROM property JOIN category ON property.property_category= category.cat_id";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute();
            $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $hotels;
        }

        //this metthod receives hotel id and send back the detail about the hotel
        public function list_hotel_detail($id){
            $sql = "SELECT * FROM property JOIN category ON property.property_category= category.cat_id WHERE property_id= ?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$id]);
            $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
            return $hotel;
        }
        //method to create hotel
        public function create_hotel($property_category, $property_contact, $property_filename, $property_price, $property_name){
            $sql = "INSERT INTO property(property_category, property_contact, property_filename, property_price, property_name) VALUES(?, ?, ?, ?, ?)";
            $stmt = $this->dbconn->prepare($sql);
            $res = $stmt->execute([$property_category, $property_contact, $property_filename, $property_price, $property_name]);
            if($res){
                $id = $this->dbconn->lastInsertId();
                return $id;
            }else{
                return false;
            }
        }

        //this method updates an hotel when given the id of the hotel and things to update

        public function update_hotel($property_category, $property_contact, $property_filename, $property_price, $property_name, $hotel_id){
            $sql = "UPDATE property SET property_category = ?, property_contact=?, property_filename= ?, property_price = ?, property_name=? WHERE property_id =? ";
            $stmt = $this->dbconn->prepare($sql);
            $res = $stmt->execute([$property_category, $property_contact, $property_filename, $property_price, $property_name, $hotel_id]);
            return $res;
        }





    }


    // $hotel1 = new Hotel;
    // echo "<pre>";
    // print_r($hotel1->list_hotel_detail(3));
    // echo "</pre>";


?>