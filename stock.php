<?php


include("config/connection.php");
$sql = "SELECT * FROM items JOIN retailer_item on items.items_id =retailer_item.retailer_item_items_id JOIN stock on stock.Stock_Retailer_items_id =retailer_item.retailer_item_items_id";

$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id =  $_POST['delete'];
    $sql = "DELETE FROM items WHERE items_id ='$id'";

    if ($conn->query($sql)) {
        $sql = "DELETE FROM stock WHERE Stock_Retailer_items_id ='$id'";
        if ($conn->query($sql)) {
            echo "<script>
            alert('delete operation sucessful');
            window.location.href='stock.php';

            </script>";;;
        } else {
            echo "<script>
            alert('delete operation unsucessful');

            </script>";;;
        }
    } else {
        echo "<script>
        alert('delete operation unsucessful');

        </script>";;;
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/styles/portal.css">
    <title>Stock</title>
</head>

<body>

    <section class="stock">
        <form method="POST" action="">
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
                            Price
                        </th>
                        <th>
                            Initail Stock
                        </th>
                        <th>
                            Stock Sold
                        </th>
                        <th>
                            Stock Left
                        </th>
                        <th>
                            Batch No
                        </th>

                        <th>
                            Description
                        </th>



                        <th>
                            Remove
                        </th>
                    </tr>

                </thead>
                <tbody>

                    <?php
                    while ($row = $result->fetch_assoc()) {


                    ?>

                        <tr>
                            <td> <img class="item-img" src="<?php echo 'uploads/' . $row['retailer_item_link']; ?>" alt="no image"></td>
                            <td> <?php echo $row['items_id']; ?></td>




                            <td> <?php echo $row['item_name']; ?></td>




                            <td> <?php echo $row['retailer_item_price']; ?></td>




                            <td> <?php echo $row['Stock_initial']; ?></td>
                            <td> <?php echo $row['Stock_sold']; ?></td>

                            <td> <?php echo $row['Stock_left']; ?></td>





                            <td> <?php echo $row['retailer_items_batch_no']; ?></td>









                            <td> <?php echo $row['item_description']; ?></td>


                            <td> <button name="delete" value="<?php echo $row['items_id'] ?>">Remove</button> </td>


                        </tr>


                    <?php } ?>


                </tbody>
            </table>

    </section>

    </table>


    <div class="bottom">
        <a href="portal.php"> Go back Home</a>
    </div>

</body>

</html>