<?php
include "db_function.php";

// Retrieve user input
$email = $_POST['email'];
$pwd = $_POST['pwd'];

$db_name = "registration_details";
$tb_name = "users";

// Connect to database
$con = connect_to_database("localhost", "root", "");

$con->select_db($db_name);

// Query to fetch hashed password from the database based on the provided email
$sql = "SELECT hash_pwd FROM users WHERE email = '$email' AND hash_pwd = '$pwd'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "$result->num_rows<br>";
    // Fetch the hashed password from the result set
    $row = $result->fetch_assoc();
    $hashed_password = $row['hash_pwd'];
    echo $hashed_password;
    
    // Verify the provided password against the hashed password
    if ($hashed_password) {
        // Password is correct, authentication successful
        echo "Password verified successfully!";
        // Here you can redirect the user to a different page or perform additional actions
    } else {
        // Password is incorrect
        echo "Incorrect password! <br>";

    }
} else {
    // No user found with the provided email
    echo "No user found with the provided email!";
}

// Close database connection
$con->close();
?>