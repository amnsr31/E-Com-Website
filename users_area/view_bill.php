<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <?php
    $order_id = $_GET['order_id']; // Get the order ID from the URL parameter
    // Get the order details from the database
    $get_order_details = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result_orders = mysqli_query($con, $get_order_details);
    $row_orders = mysqli_fetch_assoc($result_orders);
    $user_id = $row_orders['user_id'];
    $amount_due = $row_orders['amount_due'];
    $invoice_number = $row_orders['invoice_number'];
    $total_products = $row_orders['total_products'];
    $order_date = $row_orders['order_date'];

    // Get the user payment details from the database
    $get_user_payment_details = "SELECT * FROM user_payments WHERE order_id = $order_id";
    $result_user_payment = mysqli_query($con, $get_user_payment_details);
    $row_user_payment = mysqli_fetch_assoc($result_user_payment);
    $billing_name = $row_user_payment['billing_name'];
    $billing_email = $row_user_payment['billing_email'];
    $billing_address = $row_user_payment['billing_address'];
    $paypal_payment_id = $row_user_payment['paypal_payment_id'];
    ?>
    <div class="container">
        <h1>Srivastava E-Store</h1>
        <h2>Invoice</h2>
        <table>
            <tr>
                <th>Invoice Number:</th>
                <td><?php echo $invoice_number; ?></td>
            </tr>
            <tr>
                <th>Order Date:</th>
                <td><?php echo $order_date; ?></td>
            </tr>
            <tr>
                <th>Customer Name:</th>
                <td><?php echo $billing_name; ?></td>
            </tr>
            <tr>
                <th>Customer Email:</th>
                <td><?php echo $billing_email; ?></td>
            </tr>
            <tr>
                <th>Amount:(in $)</th>
                <td><?php echo $amount_due; ?></td>
            </tr>
            <tr>
                <th>Total Products:</th>
                <td><?php echo $total_products; ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo $billing_address; ?></td>
            </tr>
            <tr>
                <th>Paypal id:</th>
                <td><?php echo $paypal_payment_id; ?></td>
            </tr>
        </table>
    </div>
    <script>
        function printBill() {
            window.print();
        }
    </script>

    <div class="container">
        <!-- your existing HTML code goes here -->
        <button onclick="printBill()">Print</button>
    </div>

</body>

</html>