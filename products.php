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
    <link rel="stylesheet" href="static/styles/portal.css">
    <title>Products</title>
</head>
<?php
include("config/connection.php");
$sql = "SELECT * FROM items JOIN retailer_item WHERE items.items_id =retailer_item.retailer_item_items_id and retailer_item.retailer_items_quantity >1";



$result = $conn->query($sql);

$log_id = $_SESSION['login_id'];

$sql1 = "SELECT * FROM customer WHERE customer_login_id ='$log_id'";
$id_ref = $conn->query($sql1);
$row = $id_ref->fetch_assoc();
$cus_id =  $row["customer_id"];





if ($_SERVER["REQUEST_METHOD"] == 'POST') {


    $item_id = $_POST['item'];
    $dates = date("Y/m/d");
    $ref = "ref" . rand();
    if (empty($_POST["quantity"])) {
        $quantity = 1;
    } else {
        $quantity = $_POST["quantity"];
    }


    $sql = "INSERT INTO orders (orders_ref,orders_date,orders_customer_id)  VALUES('$ref','$dates','$cus_id')";
    if ($conn->query($sql) == TRUE) {
        $order_id = mysqli_insert_id($conn);



        $sql = "INSERT INTO order_items (order_item_order_id,order_item_retailer_items_id,order_item_quantity) VALUES($order_id,$item_id,'$quantity')";
        if ($conn->query($sql) == TRUE) {

            $payment_ref = "pymt" . $order_id . rand();
            //calculate the amount

            $sql1 = "SELECT retailer_item_price  FROM retailer_item WHERE retailer_item_items_id ='$item_id'";
            $amount_ref = $conn->query($sql1);
            $row = $amount_ref->fetch_assoc();
            $amount =  $row["retailer_item_price"];
            $total_amt = $quantity * $amount;

            $sql = "INSERT INTO  payment (payment_amount,payment_mode,payment_date,payment_ref,payment_order_id) VALUES('$total_amt','MPESA','$dates','$payment_ref','$order_id')";
            if ($conn->query($sql)) {



                $sql = "
                UPDATE stock  set Stock_sold =(Stock_sold +'$quantity') ,Stock_left =(Stock_initial-Stock_sold) WHERE Stock_retailer_items_id =$item_id;


                ";
                $sql1 = " UPDATE retailer_item set retailer_items_quantity =(retailer_items_quantity - '$quantity') WHERE retailer_item_items_id =$item_id;";



                if ($conn->query($sql) and $conn->query($sql1)) {
                    print "
                    <script>
                    alert('order successfully placed');

                    </script>
                    ";
                } else {
                    print $conn->error;

                    print "
                    <script>
                    alert('a problem has occured');

                    </script>
                    ";
                }
            } else {

                print "
                <script>
                alert('a problem has occured');

                </script>
                ";
            }
        } else {
            print "
            <script>
            alert('a problem has occured');

            </script>
            ";
        }
    } else {

        print "
        <script>
        alert('a problem has occured');

        </script>
        ";
    }
}

?>

<body>

    <h3>Available Items</h3>
    <section class="stock">

        <table>
            <thead>
                <tr>
                    <th>
                        Image
                    </th>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Price
                    </th>


                    <th>
                        Description
                    </th>
                    <th>
                        Select quantity
                    </th>

                    <th>
                        Buy
                    </th>

                </tr>

            </thead>
            <tbody>
                <form method="POST" action="">

                    <?php
                    while ($row = $result->fetch_assoc()) {


                    ?>

                        <tr>

                            <td> <img class="item-img" src="<?php echo 'uploads/' . $row['retailer_item_link']; ?>" alt="no image"></td>
                            <td> <?php echo $row['items_id']; ?></td>





                            <td> <?php echo $row['item_name']; ?></td>




                            <td> <?php echo $row['retailer_items_quantity']; ?></td>




                            <td> <?php echo $row['retailer_item_price']; ?></td>



                            <td> <?php echo $row['item_description']; ?></td>
                            <td>
                                <input type="number" name="quantity" id="">



                            </td>


                            <td>

                                <button type="submit" name="item" value="<?php echo $row['items_id'] ?> ">Buy</button>
                            </td>



                        </tr>




                    <?php } ?>


                </form>
            </tbody>
        </table>



    </section>

    <div class="bottom">
        <a href="dashboard.php"> Go back Home</a>
    </div>

</body>

</html>