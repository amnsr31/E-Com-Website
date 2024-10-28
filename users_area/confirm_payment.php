<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

$billing_name = '';
$billing_email = '';
$billing_address = '';

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];

    $billing_name = $_POST['billing_name'] ?? '';
    $billing_email = $_POST['billing_email'] ?? '';
    $billing_address = $_POST['billing_address'] ?? '';

    // Prepare the insert query using prepared statement
    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, billing_name, billing_email, billing_address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($stmt, 'isssss', $order_id, $invoice_number, $amount, $billing_name, $billing_email, $billing_address);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }

    $update_orders = "UPDATE `user_orders` SET order_status = 'Complete' WHERE order_id = $order_id";
    $result_orders = mysqli_query($con, $update_orders);
}

// PayPal transaction handling
if (isset($_POST['paypal_payment_id'])) {
    $paypal_payment_id = $_POST['paypal_payment_id'];
    $amount = $_POST['paypal_amount'];

    $billing_name = $_POST['billing_name'] ?? '';
    $billing_email = $_POST['billing_email'] ?? '';
    $billing_address = $_POST['billing_address'] ?? '';

    // Prepare the insert query using prepared statement
    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, paypal_payment_id, billing_name, billing_email, billing_address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($stmt, 'issssss', $order_id, $invoice_number, $amount, $paypal_payment_id, $billing_name, $billing_email, $billing_address);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the PayPal payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }

    $update_orders = "UPDATE `user_orders` SET order_status = 'Complete' WHERE order_id = $order_id";
    $result_orders = mysqli_query($con, $update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-secondary" background="https://www.digitalinfoways.com/wp-content/uploads/2020/12/Ecommerce-Website-Design-Main-Banner.jpg">
    <div class="container my-5">
        <h1 class="text-center text-warning">Confirm payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="invoice_number" class="text-light">Invoice Number</label>
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" id="invoice_number" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>

            <!-- Added billing form -->
            <h3 class="text-center text-warning">Billing Information</h3>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="billing_name" class="text-light">Name</label>
                <input type="text" class="form-control w-50 m-auto" name="billing_name" id="billing_name" value="<?php echo $billing_name ?>" required>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="billing_email" class="text-light">Email</label>
                <input type="email" class="form-control w-50 m-auto" name="billing_email" id="billing_email" value="<?php echo $billing_email ?>" required>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="billing_address" class="text-light">Address</label>
                <input type="text" class="form-control w-50 m-auto" name="billing_address" id="billing_address" value="<?php echo $billing_address ?>" required>
            </div>
            <!-- End of billing form -->

            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-success py-2 px-3 border-0 text-light" value="COD" name="confirm_payment">
                <div id="paypal-button-container"></div>
            </div>
        </form>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=ARmVPkDtVJJAl4mOSqMaZVKy9goWgGaQE54L1faFcceIvN3y_gl_gSexHsJQ3nstAkJ6D4dbq33LtQsc&currency=USD"></script>
    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $amount_due ?>'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');

                    // Store PayPal transaction data in the database
                    var paypal_payment_id = details.id;
                    var paypal_amount = details.purchase_units[0].amount.value;

                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '';

                    var paymentIdField = document.createElement('input');
                    paymentIdField.type = 'hidden';
                    paymentIdField.name = 'paypal_payment_id';
                    paymentIdField.value = paypal_payment_id;

                    var amountField = document.createElement('input');
                    amountField.type = 'hidden';
                    amountField.name = 'paypal_amount';
                    amountField.value = paypal_amount;

                    var billingNameField = document.createElement('input');
                    billingNameField.type = 'hidden';
                    billingNameField.name = 'billing_name';
                    billingNameField.value = document.getElementById('billing_name').value;

                    var billingEmailField = document.createElement('input');
                    billingEmailField.type = 'hidden';
                    billingEmailField.name = 'billing_email';
                    billingEmailField.value = document.getElementById('billing_email').value;

                    var billingAddressField = document.createElement('input');
                    billingAddressField.type = 'hidden';
                    billingAddressField.name = 'billing_address';
                    billingAddressField.value = document.getElementById('billing_address').value;

                    form.appendChild(paymentIdField);
                    form.appendChild(amountField);
                    form.appendChild(billingNameField);
                    form.appendChild(billingEmailField);
                    form.appendChild(billingAddressField);

                    document.body.appendChild(form);
                    form.submit();
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>