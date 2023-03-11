<?php

$url = 'index.php';
header( "Location: $url" );


if(isset($_POST['saveProduct']))
{
    if(!empty($_POST['sku']) && !empty($_POST['name']) && $_POST['price'] > 0) {

        include 'connect.php';
        $conn = OpenCon();
        $sku = mysqli_real_escape_string($conn, $_REQUEST['sku']);
        $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
        $price = mysqli_real_escape_string($conn, $_REQUEST['price']);

        foreach ($_POST as $key => $value)
        {
            if (!is_array($value))
            {
                if ($key == 'productType')
                {
                    $result_explode = explode('|', $_POST['category-unit']);
                    $before = $result_explode[0];
                    $after = $result_explode[1];
                    $a = $value;

                    if (is_array($_POST[$a]))
                    {
                        $attribute = '';
                        foreach ($_POST[$a]as $akey => $avalue)
                        {
                            $attribute = $attribute . $avalue . 'x';
                        }
                        $attribute = rtrim($attribute, 'x');
                    }
                    else
                    {
                        $attribute = $_POST[$a];
                    }
                }
            }
        }
        $sql = "INSERT INTO `products`(`SKU`, `NAME`, `PRICE`, `ATTRIBUTE`, `CATEGORY`, `UNIT`) VALUES ('$sku','$name','$price','$attribute', '$before', '$after')";
        $result = mysqli_query($conn, $sql);
        CloseCon($conn);
    }
}
?>