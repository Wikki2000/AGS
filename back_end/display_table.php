<?php
include "db_function.php";
session_start();
header('Content-Type: application/json');

$user_id = $_SESSION["user_id"];
$db_name = "table_manager";

$con = connect_to_database("localhost", "root", "", $db_name);
$sql = "SELECT `table_name` FROM `user_tables` WHERE `user_id` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc())
{
    $students[] = $row;
}
echo json_encode($students);
?>
