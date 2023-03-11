<?php

include 'connect.php';
$conn = OpenCon();

if (isset($_GET))
{

    $result = mysqli_query($conn, "SELECT `SKU` FROM `products_table`");
    $skuList = array();
    while ($row = $result->fetch_assoc()) {
        array_push($skuList, $row['SKU']);
    }
// return information in JSON format
    echo json_encode($skuList);
}
CloseCon($conn);
?>