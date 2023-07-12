<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('function.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../inc/access_control_functions.php';

if (checkIPAccess()) {
    if($requestMethod == 'DELETE'){

            $deleteCustomer = deleteCustomer($_GET);
            echo $deleteCustomer;
        
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