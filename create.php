<?php

require_once "classes/Hotel.php";
require_once "classes/Authentication.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); // to accept  post method
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('WWW-Authenticate: Basic realm="My Realm"');


//check if their request does not contain username and password and give status code
if(!isset($_SERVER["PHP_AUTH_USER"]) || !isset($_SERVER["PHP_AUTH_PW"])){
    http_response_code(401);
    $response = [
        "success" => false,
        "message" => "Authentication Required",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}
//call a method that accept username and password and help you to check if it is correct or not
    $username = $_SERVER["PHP_AUTH_USER"];
    $password = $_SERVER["PHP_AUTH_PW"];
    $auth1 = new Authentication;
    $resp= $auth1->verify_user($username, $password);

    if(!$resp){
        http_response_code(401);
        $response = [
            "success" => false,
            "message" => "Authentication failed",
            "data" => null
        ];
        echo json_encode($response);
        exit;
    }


$rq = $_SERVER["REQUEST_METHOD"];
//check if wrong method was used
if($rq != "POST"){
    http_response_code(405);
    $response = [
        "success" => false,
        "message" => "Wrong method passed, expecting method POST",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}

$data = file_get_contents("php://input");
$data = json_decode($data);
//series of validation

//check if those properties were sent
if(!isset($data->category) || !isset($data->contact_person) || !isset($data->cover)){
    http_response_code(400);
    $response = [
        "success" => false,
        "message" => "Please supply all relevants properties as explain",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}

//validate if all these are empty
if(empty($data->category) || empty($data->contact_person) || empty($data->cover)){
    http_response_code(400);
    $response = [
        "success" => false,
        "message" => "Please supply all relevants properties as explain",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}

//call the method
$hot1 = new Hotel;
$resp = $hot1->create_hotel($data->category, $data->contact_person, $data->cover, $data->price, $data->name);

if($resp){
    http_response_code(200);
    $response = [
        "success" => true,
        "message" => null,
        "data" => $resp
    ];
    echo json_encode($response);
    exit;

}else{
    http_response_code(500);
    $response = [
        "success" => false,
        "message" => "Unable to Insert Hotel",
        "data" => null
    ];
    echo json_encode($response);
    exit;
}




?>