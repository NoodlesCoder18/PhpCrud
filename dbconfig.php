<?php

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','prabhuK18*');
define('DB_NAME','mydb');


$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn === false)
{
    die("ERROR: Could not Connect." . mysqli_connect_error());
}

?>