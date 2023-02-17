<?php

include("config/connection.php");
$date = date('Y/m/d');


$sql = "SELECT * FROM order_items JOIN payment  on payment.payment_order_id =order_items.order_item_order_id join orders on orders.orders_id=order_items.order_item_order_id and orders.orders_date ='$date';";
$results = $conn->query($sql);
$sql2 = "SELECT SUM(payment.payment_amount)as total FROM order_items JOIN payment  on payment.payment_order_id =order_items.order_item_order_id join orders on orders.orders_id=order_items.order_item_order_id and orders.orders_date ='$date';";
$total_ref = $conn->query($sql2);
$row = $total_ref->fetch_assoc();

$total = $row['total'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/styles/portal.css">
    <title>Purchases</title>
</head>

<body>

    <h3>Sales</h3>
    <div class="selection">
        <a href="orders_all.php">Select All</a>
        <a href="order_today.php">Select Today</a>
        <a href="order_week.php">Select Week</a>
        <a href="order_month.php">Select Month</a>
    </div>


    <table>
        <thead>
            <tr>
                <th>
                    #

                </th>
                <th>
                    Order_id

                </th>
                <th>
                    Retailer_id

                </th>
                <th>
                    Quantity

                </th>
                <th>
                    Payment_id

                </th>
                <th>
                    Total_amount

                </th>
                <th>
                    Payment_mode

                </th>
                <th>
                    Date

                </th>
                <th>
                    Ref

                </th>
                <th>
                    Customer_id

                </th>
            </tr>


        </thead>

        <tbody>

            <?php
            while ($row = $results->fetch_assoc()) {




            ?>


                <tr>
                    <td>
                        <?php echo $row['order_item_id']   ?>
                    </td>
                    <td>
                        <?php echo $row['order_item_order_id']   ?>
                    </td>
                    <td>
                        <?php echo $row['order_item_retailer_items_id']   ?>
                    </td>
                    <td>
                        <?php echo $row['order_item_quantity']   ?>
                    </td>
                    <td>
                        <?php echo $row['payment_id']   ?>
                    </td>
                    <td>
                        <?php echo $row['payment_amount']   ?>
                    </td>
                    <td>
                        <?php echo $row['payment_mode']   ?>
                    </td>
                    <td>
                        <?php echo $row['payment_date']   ?>
                    </td>
                    <td>
                        <?php echo $row['payment_ref']   ?>
                    </td>
                    <td>
                        <?php echo $row['orders_customer_id']   ?>
                    </td>
                </tr>

            <?php
            }





            ?>
            <tr>
                <td colspan="9">TOTAL SALES</td>
                <td><?php print $total; ?></td>
            </tr>

        </tbody>




    </table>
    <div id="print">


        <div id="bottom">
            <button type="button">print report</button>
        </div>
        <div id="bottom">
            <a href="portal.php"> Go back Home</a>
        </div>
    </div>


</body>
<script>
    const btn = document.getElementById("print");
    btn.addEventListener("click", () => {

        document.getElementById("print").style.display = "none";
        document.getElementById("selection").style.display = "none";
        window.print();
        location.reload();
    })
</script>

</html>