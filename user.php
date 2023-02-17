<?php


include("config/connection.php");
$sql = "SELECT * FROM login JOIN customer on login.login_id = customer.customer_login_id";

$result = $conn->query($sql);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $id =  $_POST['delete'];
//     echo $id;
//     $sql = "DELETE FROM login WHERE login_id ='$id'";

//     if ($conn->query($sql)) {
//         $sql = "DELETE FROM customer WHERE customer_login_id ='$id'";
//         if ($conn->query($sql)) {

//             echo "<script>
//             alert('delete operation sucessful');
//             window.location.href='stock.php';

//             </script>";;;
//         } else {
//             print $conn->error;
//             echo "<script>
//             alert('delete operation unsucessful');

//             </script>";;;
//         }
//     } else {

//         echo "<script>
//         alert('delete operation unsucessful');

//         </script>";;;
//     }
// }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/styles/portal.css">
    <title>Customer</title>
</head>

<body>
    <h3>Customer Details</h3>

    <section class="stock">
        <form method="POST" action="">
            <table>
                <thead>
                    <tr>

                        <th>
                            #
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Contact
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Location
                        </th>




                        <!-- <th>
                            Remove
                        </th> -->
                    </tr>

                </thead>
                <tbody>

                    <?php
                    while ($row = $result->fetch_assoc()) {


                    ?>

                        <tr>

                            <td> <?php echo $row['customer_id']; ?></td>




                            <td> <?php echo $row['customer_name']; ?></td>




                            <td> <?php echo $row['customer_phone_number']; ?></td>




                            <td> <?php echo $row['customer_address']; ?></td>
                            <td> <?php echo $row['customer_location']; ?></td>












                            <!-- 
                            <td> <button name="delete" value="<?php echo $row['login_id'] ?>">Remove</button> </td> -->


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