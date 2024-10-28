<h3 class="text-light mb-4 text-center"> Are you want to delete your account??</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto bg-success" name="delete" value="Yes">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto bg-danger" name="dont_delete" value="No">
    </div>
    <?php
    $useremail_session = $_SESSION['user_email'];
if(isset($_POST['delete'])){
    $delete_query="Delete from user_table where user_email='$useremail_session'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";
}

    ?>