<?php include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>

<body background="https://www.digitalinfoways.com/wp-content/uploads/2020/12/Ecommerce-Website-Design-Main-Banner.jpg">
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--bootstrap js link-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital@1&display=swap" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
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
                            <a class="nav-link text-light text-center" aria-current="page" href=""><span>Srivastava <strong>E-Store</strong></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid my-3">
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post">
                        <!-- username feild-->
                        <div class="form-outline mb-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" id="user_email" class="form-control" placeholder="Enter your Email" autocomplete="off" required="required" name="user_email" />
                        </div>
                        <!-- password field-->
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password" />
                        </div>
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Login" class="bg-warning py-2 px-3 border-0 text-light" name="user_login"><a href="forgot_password.php" class="text-danger">Forgot Password</a>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?<a href="user_registration.php" class="text-danger"> Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include("../includes/footer.php") ?>
</body>

</html>

<?php
if (isset($_POST['user_login'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $select_query = "select * from user_table where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    //cart item
    $select_query_cart = "select * from cart_details  where ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);
    if ($row_count > 0) {
        $_SESSION['user_email'] = $user_email;
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 and $row_count_cart == 0) {
                $_SESSION['user_email'] = $user_email;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            } else {
                $_SESSION['user_email'] = $user_email;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credential')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credential')</script>";
    }
}

?>