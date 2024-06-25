<?php

session_start();
include "db_function.php";
//header('Content-Type: application/json');

$user_id = $_SESSION["user_id"];
$table_name = $_SESSION["table_name"]; // created in create_table.php file

if ($_SERVER["REQUEST_METHOD"] === "POST" and $table_name)
{
    $name = htmlspecialchars($_POST["name"]);
    $reg_no = htmlspecialchars($_POST["regNo"]);
    $test = htmlspecialchars($_POST["test"]);
    $exams = htmlspecialchars($_POST["exam"]);

    $databaseName = "table_manager";
    
    if(!preg_match("/^[a-zA-Z0-9._ ]+$/", $name))
        echo "Invalid name";
    else if(!preg_match("/^[a-zA-Z0-9._ \/]+$/", $reg_no))
        echo "Invalid Registration number";
    else if(!preg_match("/^[0-9.]+$/", $test))
        echo "Invalid test score";
    else if(!preg_match("/^[0-9.]+$/", $exams))
        echo "Invalid exam score";
    else
    {
        $grade = "";
        $total = floatval($test) + floatval($exams);
        if ($total <= 44)
            $grade = "F";
        else if ($total >= 44 and $total <= 49)
            $grade = "D";
        else if ($total >= 50 and $total <= 59)
            $grade = "C";
        else if ($total >= 60 and $total <= 69)
            $grade = "B";
        else if ($total >= 70 and $total <= 100)
            $grade = "A";
        else
        {
            echo "Ops! The total score {$total} is higher than standard of 100%";
            exit;
        }
        
        $con = connect_to_database("localhost", "root", "", $databaseName);
        $sql = "SELECT * FROM `$table_name` WHERE `id` = ? OR `name` = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $reg_no, $name);
        $stmt->execute();
        $tb_obj = $stmt->get_result();
        if ($tb_obj->num_rows > 0)
        {
            $rows = $tb_obj->fetch_assoc();
            $response = "";
            while ($rows)
            {
                if ($rows["name"] === $name)
                    $response = "Student name exists already";
                else if ($rows["id"] === $reg_no)
                    $response = "Student registration number exists already";
                break;
            }
            echo $response;
        }
        else
        {
            $sql = "INSERT INTO `$table_name` (`name`, `id`, `test`, `exam`, `total`, `grade`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssddds", $name, $reg_no, $test, $exams, $total, $grade);
            $stmt->execute();
            echo "Added successfully";
        }
    }
}
else
{
    echo "Ops! No table selected";
}
?>