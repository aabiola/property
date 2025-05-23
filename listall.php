<?php
require_once "classes/Hotel.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");

// does this request has the right method: GET


$rq = $_SERVER["REQUEST_METHOD"];
//check if wrong method was used
if($rq != "GET"){
    http_response_code(405);
    $response = [
        "success" => false,
        "message" => "Wrong method passed, expecting method GET",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}

//call the method
$ho = new Hotel; 
$hotels = $ho -> list_all_hotels();
$data = [];
if($hotels && is_array($hotels)){
    foreach($hotels as $hotel){
        $ho = [];
        $ho["id"] = $hotel["property_id"];
        $ho["category"] = $hotel["cat_name"];
        $ho["contact_person"] = $hotel["property_contact"];
        $ho["price"] = $hotel["property_price"];
        $ho["name"] = $hotel["property_name"];
        $ho["date_reg"] = $hotel["property_date"];
        $ho['image'] = $hotel['property_filename'];
        array_push($data, $ho); 
    }
    http_response_code(200);
    $response = [
        "success" => true,
        "message" => null,
        "data" => $data
    ];
    echo json_encode($response);
}








?>