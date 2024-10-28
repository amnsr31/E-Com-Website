<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['user_email'];  ?></title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital@1&display=swap" rel="stylesheet">
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
                            <a class="nav-link text-light" href="profile.php?edit_account"><i class='fas fa-user'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Total Price:$<?php total_cart_price(); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--calling cart function-->
        <?php
        cart();
        ?>
        <br>
        <!-- second child-->
        </br>
        <div class="row">
            <div class="col-md-2 p-0">
                <ul class="navbar-nav bg-dark text-center" style="height: 100vh">
                    <li class="nav-item bg-primary">
                        <a class="nav-link text-light" href="#">
                            <h4>Your profile</h4>
                        </a>
                    </li>
                    <?php $user_email = $_SESSION['user_email']; ?>
                    <br>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            <i class="fas fa-user-edit me-2"></i>Edit Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            <i class="fas fa-box me-2"></i>My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">
                            <i class="fas fa-trash-alt me-2"></i>Delete Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        <div class="col-md-10"><?php get_user_order_details();
                                if (isset($_GET['edit_account'])) {
                                    include('edit_account.php');
                                }
                                if (isset($_GET['my_orders'])) {
                                    include('user_orders.php');
                                }
                                if (isset($_GET['delete_account'])) {
                                    include('delete_account.php');
                                }
                                ?>
        </div>

    </div>
    <!-- last child -->
    <!-- include footer-->
    <br>
    <?php include("../includes/footer.php") ?>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>