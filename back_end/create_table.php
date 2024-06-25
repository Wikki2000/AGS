<?php
include "db_function.php";
session_start();
header('Content-Type: application/json');

/**
 * Both create table and select table will go to this file
 */

if (!isset($_SESSION["user_id"]))
{
    echo json_encode(["message" => "User not logged in"]);
    exit;
}

$userId = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $tb_name = htmlspecialchars($_POST["tableName"]);
    $tableName = $userId . "_" . $tb_name; // Add id to make table name unique (bcoz no two table in db can have same name)
    $databaseName = "table_manager";
    $tableAttr = [
        "name VARCHAR(50) UNIQUE NOT NULL, ",
        "id VARCHAR(50) UNIQUE NOT NULL, ",
        "test FLOAT, ",
        "exam FLOAT, ",
        "total FLOAT, ",
        "grade VARCHAR(4), ",
        "PRIMARY KEY (id)"
    ];

    $con = connect_to_database("localhost", "root", "", $databaseName);

    // Check if the table already exists for the user
    $sql = "SELECT * FROM `user_tables` WHERE `user_id` = ? AND `table_name` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $userId, $tableName);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName))
        echo json_encode(["message" => "Invalid table name."]);
    else if ($result->num_rows > 0)
        echo json_encode(["message" => "Table already exists"]);
    else
    {
        create_table($databaseName, $tableName, $tableAttr, $con);
        // Insert record into user_tables
        $sql = "INSERT INTO `user_tables` (`user_id`, `table_name`) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $userId, $tableName);
        if ($stmt->execute())
        {
            $_SESSION["table_name"] = $tableName;
            echo json_encode([
                "message" => "Table created successfully",
                "tb_name" => $tb_name
            ]);
            
        }
        else
        {
            echo json_encode(["message" => "Error creating table"]);
        }
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
}
?>