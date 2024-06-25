<?php
include "db_function.php";
header('Content-Type: application/json');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $response = ["message" => "Invalid email or password"];
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password1']);

    $tb_name = "users";
    $db_name = "table_manager";
    $con = new mysqli("localhost", "root", "", $db_name);
    $user = get_table_rows($con, $email);
    if ($user)
    {
        if (password_verify($password, $user["password"]))
        {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION['name'] = $user["name"];
            $response = [
                "message" => "Login Successful",
                "redirect" => "../front_end/dash_board.html"
            ];
        }
    }
    echo json_encode($response);
}
?>