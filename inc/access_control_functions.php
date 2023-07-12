<?php
function checkIPAccess() {
    $clientIP = $_SERVER['REMOTE_ADDR'];
    $allowedIPs = [
        '127.0.0.1'
    ];

    if (in_array($clientIP, $allowedIPs)) {
        return true;
    } else {
        return false;
    }
}
?>