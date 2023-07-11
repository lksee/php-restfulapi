<?php

require '../inc/dbcon.php';

function error422($message) {
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header('HTTP/1.0 422 Unprocessable Entity');
    echo json_encode($data);
    exit();
}

function storeCustomer($customerInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, trim($customerInput['name']));
    $email = mysqli_real_escape_string($conn, trim($customerInput['email']));
    $phone = mysqli_real_escape_string($conn, trim($customerInput['phone']));

    if (empty($name)) {
        return error422('Enter your name');
    } elseif (empty($email)) {
        return error422('Enter your email');
    } elseif (empty($phone)) {
        return error422('Enter your phone number');
    } else {
        $query = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Customer Created Successfully',
            ];
            header('HTTP/1.0 201 Created');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header('HTTP/1.0 500 Internal Server Error');
            return json_encode($data);
        }
    }
}

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