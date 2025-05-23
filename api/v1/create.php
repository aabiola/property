<?php
#http://localhost/property/api/v1/create.php
require_once "classes/Hotel.php";
require_once "classes/Authentication.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

// // header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
 

#the following headers are needed for authentication
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// header("WWW-Authenticate: Basic realm='My Realm'");

// #check to be sure the request contains username and password
// if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])){
//     http_response_code(401);
//     $response = [
//         "status"=>false,
//         "message"=>"Authentication Required!",
//         "data"=>null,
//     ];
//     echo json_encode($response);
//     exit();
// }
#they must have supplied username and pwd, retrive them
// $username = $_SERVER['PHP_AUTH_USER'];
// $password = $_SERVER['PHP_AUTH_PW'];
// $auth = new Authentication ;
// $rsp = $auth->verify_merchat($username,$password);//require Authentication.php
// if(!$rsp){
//     http_response_code(401);
//     $response = [
//         "status"=>false,
//         "message"=>"Authentication Failed!",
//         "data"=>null,
//     ];
//     echo json_encode($response);
//     exit();
// }

#check 1: does this request have method post?
$rq = $_SERVER['REQUEST_METHOD'];

if($rq !='POST'){
    http_response_code(405);//Bad Method

    $response = [
        "status"=>false,
        "message"=>"Only method POST is allowed!",
        "data"=>"Only Method Post is allowed",
    ];
    echo json_encode($response);
    exit();
}

$h = new Hotel;

#check 2: The data supplied to this endpoint is in the correct format
$data = file_get_contents("php://input");
$jsondata = json_decode($data);//converts the json in the request to PHP object. 



#sample data format expected
#{"hotel_name":"WaterFall Hotel","hotel_contact":"Tony","hotel_pix":"https://picsum.photos/200/","hotel_price":15000}
// $name = $jsondata->hotel_name;
// $contact = $jsondata->hotel_contact;
// $pix=$jsondata->hotel_pix;
// $price = $jsondata->hotel_price;

if(!isset($jsondata->hotel_name) || !isset($jsondata->hotel_contact) || !isset($jsondata->hotel_pix) || !isset($jsondata->hotel_price)){
    http_response_code(400); //BAD request
    $response=[
        "status"=>false,
        "message" =>"JSON is expected",
        "data"=>null
    ];
    echo json_encode($response);
    exit();
}

#check 3: Confirm that the data are not empty
if(empty($jsondata->hotel_name) || empty($jsondata->hotel_contact) || empty($jsondata->hotel_pix)){
    http_response_code(400); //BAD request
    $response=[
        "status"=>false,
        "message" =>"Ensure you supply data for the json keys",
        "data"=>null
    ];
    echo json_encode($response);
    exit();
}

//call the method to insert

$resp = $h->create_hotel($jsondata->hotel_contact,$jsondata->hotel_pix,$jsondata->hotel_price,$jsondata->hotel_name);

if($resp){//insertion was successful
    http_response_code(200);//resource created.
    $response=[
        "status"=>true,
        "message" =>"Hotel added successfully",
        "data"=>$resp
    ];
    echo json_encode($response);
    exit();

}else{//not successful
    http_response_code(500);#
    $response=[
        "status"=>false,
        "message" =>"Error adding hotel to database",
        "data"=>null
    ];
    echo json_encode($response);
    exit();
}

?>