<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('function.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../inc/access_control_functions.php';

if (checkIPAccess()) {
    if ($requestMethod == 'POST') {

        $inputData = json_decode(file_get_contents("php://input"), true);
    
        if (empty($inputData)) {
            $storeCustomer = storeCustomer($_POST);
        } else {
            $storeCustomer = storeCustomer($inputData);
        }
    
        echo $storeCustomer;
    
    } else {
        $data = [
            'status' => 405,
            'message' => $requestMethod. ' method not allowed',
        ];
        header('HTTP/1.0 405 Method Not Allowed');
        echo json_encode($data);
    }
} else {
    $data = [
        'status' => 403,
        'message' => 'Access Forbidden',
    ];
    header('HTTP/1.0 403 Forbidden');
    echo json_encode($data);
}


?>