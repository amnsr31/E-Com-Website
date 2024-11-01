<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body background="https://www.digitalinfoways.com/wp-content/uploads/2020/12/Ecommerce-Website-Design-Main-Banner.jpg">
    <?php
    $user_email = $_SESSION['user_email'];
    $get_user = "select * from user_table where user_email='$user_email'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    //echo $user_id;
    ?>
    <table class="table table-bordered mt-5">
        <thead class="bg-primary text-light">
            <tr>
                <th>Sl no</th>
                <th>Amount($)</th>
                <th>Total products</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Bill</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-dark text-light">
            <?php
            $get_order_details = "select * from user_orders where user_id=$user_id";
            $result_orders = mysqli_query($con, $get_order_details);
            $number = 1;
            while ($row_orders = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row_orders['order_id'];
                $user_id = $row_orders['user_id'];
                $amount_due = $row_orders['amount_due'];
                $total_products = $row_orders['total_products'];
                $invoice_number = $row_orders['invoice_number'];
                $order_status = $row_orders['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }
                $order_date = $row_orders['order_date'];
                echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                if ($order_status == 'Complete') {
                    // Display a link to view the bill
                    echo "<td><a href='view_bill.php?order_id=$order_id' class='text-light'>View Bill</a></td>
                    <td>Paid</td>";
                } else {
                    echo "<td></td>
                    <td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td>";
                }
                echo "</tr>";
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>