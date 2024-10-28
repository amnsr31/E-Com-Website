<?php include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body background="https://www.digitalinfoways.com/wp-content/uploads/2020/12/Ecommerce-Website-Design-Main-Banner.jpg">
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <img src="../image/Logo.jfif" alt="" class="Logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href=""><span>Srivastava <strong>E-Store</strong></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="profile.php?edit_account"><i class='fas fa-user'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Total Price: $<?php total_cart_price(); ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <div class="input-group">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                            <button class="btn btn-outline-primary" type="submit" name="search_data_product">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <!--php code to access user id-->
        <?php
        $user_ip = getIPAddress();
        $get_user = "select * from user_table where user_ip='$user_ip'";
        $result = mysqli_query($con, $get_user);
        $run_query = mysqli_fetch_array($result);
        $user_id = $run_query['user_id'];

        ?>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="col-md-6">
                    <br>
                    <br>
                    <br>
                    <a href="order.php?user_id=<?php echo $user_id ?>">
                        <h2 class="text-center text-light" name="checkout" value="checkout">Checkout..</h2>
                    </a>
                </div>
            </div>
        </div>
</body>

</html>