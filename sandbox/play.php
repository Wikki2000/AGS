<?php

//Check the method use
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //get the value of sign up button were name set to signup, to be sure it is click before doing anything
    if (isset($_POST['signup']))
    {
        $username = $_POST['name'];
        $pwd = $_POST['pwd'];
        $sql = 'SELECT * FROM tb_name WHERE username = $username';
        $result = mysqli_query($con, $sql);
        if ($result)
        {
            $rows = mysqli_num_rows($result);
            {
                if ($rows > 0)
                {
                    echo "user exists";
                }
                else{
                    //insert values
                }
            }
        }

    }
}
?>