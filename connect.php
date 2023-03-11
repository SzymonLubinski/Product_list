<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "product_list";

//    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}

?>