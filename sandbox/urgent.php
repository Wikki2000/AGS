<?php
$pwd = "wisdom";
$pwd1 = "ugtffdfdf";

$hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
echo "$hash_pwd";

if (password_verify($pwd1, $hash_pwd))
{
    echo "Password verified";
}
else{
    echo "Invalid";
}