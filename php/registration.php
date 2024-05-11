<?php
include "db_function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['submit']))
    {
        /* Retrieve user input from form */
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pwd1 = $_POST['pwd1'];
        $pwd2 = $_POST['pwd2'];

        /* Setting of variables */
        $db_name = "registration_details";
        $tb_name = "users";
        $tb_col = ["fname", "lname", "email", "hash_pwd"];
        $tb_attr = ["id INT AUTO_INCREMENT PRIMARY KEY, ",
                    "fname VARCHAR(50), ",
                    "lname VARCHAR(50), ",
                    "email VARCHAR(50), ",
                    "hash_pwd VARCHAR(255)"];

        $hash_pwd = password_hash($pwd1, PASSWORD_DEFAULT);

        $tb_val = [$fname, $lname, $email, $hash_pwd];

        $con = connect_to_database('localhost', 'root', "");
        create_database($db_name, $con);
        create_table($db_name, $tb_name, $tb_attr, $con);

        insert_data($tb_name, $tb_col, $tb_val, $con);

        echo "<h1>Sign up Successful!</h1>";
        echo "<p>Click to login</p>";
        echo "<a href='../login_page.html'>Login</a>";

        /* Close the database connection */
        mysqli_close($con);
    }
}
?>
