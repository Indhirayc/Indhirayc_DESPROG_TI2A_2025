<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['csrf-token'])) {
    $_SESSION['csrf-token'] = bin2hex(random_bytes(32));
}

$headers = apache_request_headers();
if(isset($headers['csrf-token'])) {
    if($headers['csrf-token'] !== $_SESSION['csrf-token']) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
} else {
    exit(json_encode(['error' => 'No CSRF token.']));
}

?>