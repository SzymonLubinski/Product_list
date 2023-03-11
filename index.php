<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>

    <div class="container mb-3">
        <header class="row align-items-end mt-3">
            <div class="col-8 font-weight-bold">
                <h2 class="m-0">Product List</h2>
            </div>
            <div class="col-2">
                <a href="add-product.html" class="btn btn-primary">ADD</a>
            </div>
            <div class="col-2">
                <form action="index.php" method="post" id="mass-delete">
                    <button id="delete-product-btn" class="btn btn-primary" name="btn-delete" type="submit">MASS DELETE</button>
                </form>
            </div>
        </header>
        <hr>
        <main class="row">

            <?php

            class Product
            {
                public function __construct($SKU, $NAME, $PRICE, $ATTRIBUTE, $CATEGORY, $UNIT)
                {
                    echo '
                    <div class="col-lg-3 col-md-4 col-sm-6 mt-1">
                        <div class="card p-2">
                            <input type="checkbox" class="form-check-input m-2 delete-checkbox" name="check-card[]" value="'. $SKU .'" form="mass-delete">
                            <div class="row g-1 text-center">
                                <div class="col-12">'. $SKU .'</div>
                                <div class="col-12">'. $NAME .'</div>
                                <div class="col-12">'. $PRICE .' $</div>
                                <div class="col-12">' . $CATEGORY . ' ' . $ATTRIBUTE . ' ' . $UNIT . '</div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }

            include 'connect.php';
            $conn = OpenCon();

            if(isset($_POST['btn-delete']))
            {
                if(!empty($_POST['check-card']))
                {
                    foreach ($_POST['check-card'] as $card)
                    {
                        $sql = "DELETE FROM `products` WHERE `SKU` = " . '"' . $card . '"';
                        if(mysqli_query($conn, $sql))
                        {
                            echo '';

                        }
                        else
                        {
                            echo '';
                        }
                    }
                }
            }

            $result = mysqli_query($conn, "Select * from products");
            while ($row = $result->fetch_assoc()) {
                $el = new Product($row['SKU'], $row['NAME'], $row['PRICE'], $row['ATTRIBUTE'], $row['CATEGORY'], $row['UNIT']);
            }

            CloseCon($conn);

            ?>

        </main>
    </div>

    <footer class="fixed-bottom mt-3">
        <div class="row-col-12">
            <p class="bg-dark text-light text-center m-0 p-3">Product List by Szymon Lubiński</p>
        </div>
    </footer>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>
