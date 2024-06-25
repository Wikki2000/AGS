<?php
session_start();

if (isset($_SESSION["name"]))
{
    echo json_encode(["name" => $_SESSION["name"]]);
} else {
    echo json_encode(["error" => "No session data found."]);
}
?>