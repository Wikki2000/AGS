<?php
include "db_function.php";
header('Content-Type: application/json');

$response = [
    "message" => "Registration Successful",
    "redirect" => "../front_end/login_page.html"
];
if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    $uuid = md5(uniqid(rand(), true));
    $first_name = explode(" ", $name)[0];
    $id = $first_name . "_" . $uuid;

    $tb_name = "users";
    $db_name = "table_manager";

    $tb_col = ["id", "name", "email", "password"];
    $tb_val = [$id, $name, $email, $password];

    $con = new mysqli("localhost", "root", "", $db_name);

    $rows = get_table_rows($con, $email);
    if ($rows)
    {
        $response = ["message" => "User exist already"];
        echo json_encode($response);
        exit;
    }
    insert_data($tb_name, $tb_col, $tb_val, $con);
    echo json_encode($response);
}
?>