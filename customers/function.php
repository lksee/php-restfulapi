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

function getCustomer($customerParams) {
    global $conn;

    if($customerParams['id'] == null) {
        return error422('Enter your customer id.');
    }

    $customerId = mysqli_real_escape_string($conn, trim($customerParams['id']));

    $query = "SELECT * FROM customers WHERE id = '$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result) {
            
            if(mysqli_num_rows($result) == 1) {
    
                $res = mysqli_fetch_assoc($result);
                
                $data = [
                    'status' => 200,
                    'message' => 'Customer Fetch Successfully',
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
    }
}

function updateCustomer($customerInput, $customerParams) {
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422('Customer id not found in URL.');
    } elseif ($customerParams['id'] == null) {
        return error422('Enter your customer id.');
    }

    $customerId = mysqli_real_escape_string($conn, trim($customerParams['id']));

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
        $query = "UPDATE customers SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$customerId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'Customer Updated Successfully',
            ];
            header('HTTP/1.0 200 OK');
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

function deleteCustomer($customerParams) {
    global $conn;

    if (!isset($customerParams['id'])) {
        return error422('Customer id not found in URL.');
    } elseif ($customerParams['id'] == null) {
        return error422('Enter your customer id.');
    }

    $customerId = mysqli_real_escape_string($conn, trim($customerParams['id']));

    $query = "DELETE FROM customers WHERE id = '$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'status' => 200,
            'message' => 'Customer Deleted Successfully',
        ];
        header('HTTP/1.0 200 OK');
        return json_encode($data);
    } else {
        $data = [
            'status' => 404,
            'message' => 'Customer Not Found',
        ];
        header('HTTP/1.0 404 Not Found');
        return json_encode($data);
    }
}

?>