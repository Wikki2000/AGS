<?php
include "db_function.php";
//header('Content-Type: application/json');

echo json_encode(["message" => "I'm PHP"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Changed from $_GET to $_POST
    $tb_name = $_POST["tb_name"]; 
    $databaseName = "table_manager";

    $con = connect_to_database("localhost", "root", "", $databaseName);

    // Escape the table name to prevent SQL injection
    $tb_name = $con->real_escape_string($tb_name);
    
    $sql_del = "DELETE FROM `user_tables` WHERE `table_name` = '$tb_name'";
    $sql_drop = "DROP TABLE `$tb_name`";

    if ($con->query($sql_del) === TRUE && $con->query($sql_drop) === TRUE) {
        echo json_encode(["message" => "Table '$tb_name' deleted successfully."]);
    } else {
        echo json_encode(["message" => "Error deleting table: " . $con->error]);
    }

    $con->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
