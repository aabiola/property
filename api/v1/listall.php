<?php
#http://localhost/property/api/v1/listall.php
require_once "classes/Hotel.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");

// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

#check 1: does this request have method get?
$rq = $_SERVER['REQUEST_METHOD'];

if($rq !='GET'){
    http_response_code(405);//Bad Method

    $response = [
        "status"=>false,
        "message"=>"Only method GET is allowed!",
        "data"=>null,
    ];
    echo json_encode($response);
    exit();
}

$h = new Hotel;

$hotels = $h->get_all_hotels();//[[],[],[],[]] convert to [{},{},{}]

if(is_array($hotels)){
    http_response_code(200);//OK

    $data2return = [];
    foreach($hotels as $hotel){
        $data = [];
        $data['hotel_id'] = $hotel['property_id'];
        $data['hotel_name']  = $hotel['property_name'];
        $data['hotel_contact'] = $hotel['property_contact'];
        $data['hotel_pix'] = $hotel['property_filename'];
        $data['hotel_price'] = $hotel['property_price'];
        array_push($data2return,$data);
    }

    $response = [
        "status"=>true,
        "message"=>"Hotels successfully retrieved",
        "data"=>$data2return,
    ];
    echo json_encode($response);
}

?>