<?php
session_start();

header('Content-Type: application/json');

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    echo json_encode([
        'loggedIn' => true,
        'redirect' => '../front_end/dash_board.html'
    ]);
    exit;
}
echo json_encode(["loggedIn" => false]);
?>