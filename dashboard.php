<?php
session_start();

if (!isset($_SESSION['login_id'])) {
    header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="static/styles/portal.css">
</head>
<?php

include("./config/connection.php");

$log_id = $_SESSION['login_id'];

$sql1 = "SELECT * FROM customer WHERE customer_login_id ='$log_id'";





$details = $conn->query($sql1);
$row = $details->fetch_assoc();
$name = $row['customer_name'];
$id = $row["customer_id"];
$sql2 = "SELECT * FROM orders JOIN order_items on orders.orders_customer_id ='$id' and orders.orders_id =order_items.order_item_order_id join payment on payment.payment_order_id =orders.orders_id join items on items.items_id =order_items.order_item_retailer_items_id";

$order = $conn->query($sql2);



?>

<body>
    <section class="info">
        <h2>
            WELCOME : <?php echo $name ?>

        </h2>
    </section>


    <section class="order">
        <h3>YOUR ORDERS</h3>

        <table>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Ref
                    </th>
                    <th>
                        Item
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Amount
                    </th>


                    <th>
                        Quantity
                    </th>



                </tr>

            </thead>
            <tbody>

                <?php
                while ($row = $order->fetch_assoc()) {


                ?>

                    <tr>
                        <td> <?php echo $row['orders_id']; ?></td>




                        <td> <?php echo $row['orders_ref']; ?></td>
                        <td> <?php echo $row['item_name']; ?></td>




                        <td> <?php echo $row['orders_date']; ?></td>




                        <td> <?php echo $row['payment_amount']; ?></td>








                        <td> <?php echo $row['order_item_quantity']; ?></td>




                    </tr>


                <?php } ?>


            </tbody>
        </table>





        </div>

    </section>

    <div class="bottom">
        <a href="products.php"> view Available product</a>
    </div>
    <div class="bottom">
        <a href="logout.php"> logout</a>
    </div>



    <section class="footer ">
        <h4>About Us </h4>
        <p>
            TOI Systems is an online shop that lets you do your online shopping and also track your order and payment method
            <br>It also helps you shop from the comfort of your home.
        </p>
        <div class="icons ">
            <a href="# " class="fa fa-facebook "></a>
            <a href="# " class="fa fa-twitter "></a>
            <a href="# " class="fa fa-instagram "></a>
            <a href="# " class="fa fa-linkedin "></a>
        </div>
        <p>Made With<i class="fa fa-heart-o ">by 2bit Solutions</i></p>


    </section>

</body>

</html>