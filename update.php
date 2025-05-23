<?php

    require_once "classes/Hotel.php";
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST"); // to accept  post method
    header("Access-Control-Max-Age: 3600");

    $rq = $_SERVER["REQUEST_METHOD"];
    //check if wrong method was used
    if($rq != "PATCH"){
        http_response_code(405);
        $response = [
            "success" => false,
            "message" => "Wrong method passed, expecting method PATCH",
            "data" => null
        ];
        echo json_encode($response);
        exit;
    }

    //check if id of hotel to update is not in query string
    if(!isset($_GET["id"])){
        http_response_code(400);
        $response = [
            "success" => false,
            "message" => "Please pass the id of the property in query string",
            "data" => null
        ];
        echo json_encode($response);
        exit;
    }
    //validate if it is not a number: do these by yourself
    //pick up content of the request body
    $data = file_get_contents("php://input");
    $data = json_decode($data);
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
    //check if resource does not exist and send 404 error
    //instantiate the class and call the method
    $hot1 = new Hotel;
    $resp = $hot1 -> update_hotel($data->category, $data->contact_person, $data->cover, $data->price, $data->name, $_GET["id"]);  //id is not coming from request body but rather from query string
    if($resp){
        http_response_code(200);
        $response = [
            "success" => true,
            "message" => "Property updated successfully",
            "data" => null
        ];
        echo json_encode($response);
        exit;
    }else{
        http_response_code(500);
        $response = [
            "success" => false,
            "message" => "Unable to update Hotel",
            "data" => null
        ];
        echo json_encode($response);
        exit;
    }




?>