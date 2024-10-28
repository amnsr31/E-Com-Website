<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['user_email'];
    $select_query = "SELECT * FROM user_table WHERE user_email = '$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
}

if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    $update_query = "UPDATE user_table SET username = '$username', user_email = '$user_email', user_address = '$user_address', user_mobile = '$user_mobile' WHERE user_id = $update_id";
    $result_query_update = mysqli_query($con, $update_query);
    if ($result_query_update) {
        echo "<script>alert('Data updated successfully')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
</head>

<body background="https://www.digitalinfoways.com/wp-content/uploads/2020/12/Ecommerce-Website-Design-Main-Banner.jpg">
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="Update" class="bg-warning text-light py-2 px-3 border-0" name="user_update">
        </div>
    </form>
</body>

</html>