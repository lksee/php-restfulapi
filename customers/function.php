<?php

require '../inc/dbcon.php';

function getCustomerList() {

    global $conn;
    
    $query = "SELECT * FROM customers";
    $result = mysqli_query($conn, $query);

    if($result) {

        if(mysqli_num_rows($result) > 0) {

            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            $data = [
                'status' => 200,
                'message' => 'Customer List Fetch Successfully',
                'data' => $res,
            ];
            header('HTTP/1.0 200 OK');
            return json_encode($data);

        } else {

            $data = [
                'status' => 404,
                'message' => 'No Data Found',
            ];
            header('HTTP/1.0 404 Not Found');
            return json_encode($data);

        }

    } else {

    $data = [
        'status' => 500,
        'message' => 'Internal Server Error',
    ];
    header('HTTP/1.0 500 Internal Server Error');
    return json_encode($data);
    }

}

?>