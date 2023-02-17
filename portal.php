<?php

include("./config/connection.php");

session_start();
if (!isset($_SESSION['login_rank'])) {
    header("location:index.php");
}



$sql2 = "SELECT * FROM retailer join login on retailer.retailer_login_id = login.login_id";
$retailers = $conn->query($sql2);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $delete_id = $_POST["delete"];


    $sql = "DELETE FROM login  WHERE login_id ='$delete_id'";
    if ($conn->query($sql)) {
        $sql = "DELETE FROM retailer where retailer_login_id ='$delete_id'";
        if ($conn->query($sql)) {
            print "
            <script>
            alert('Vendor deleted successfully');
            window.location.href='portal.php';

            </script>
            ";
        } else {
            print "
            <script>
            alert('Vendor  not deleted ');


            </script>
            ";
        }
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
    <title>Homepage</title>
</head>

<body>
    <section class="header">
        <div class="logo">
            <img src="static/files/logo2.png" alt="logo">

        </div>
        <div class="links">
            <ul>
                <li> <a href="add_product.php">Add products</a></li>
                <li> <a href="vendor.php">Add vendor</a></li>
                <li> <a href="orders_all.php">View sales</a></li>
                <li> <a href="stock.php">View stock</a></li>
                <li> <a href="user.php">View customers</a></li>



            </ul>
        </div>

    </section>

    <section class="stock">
        <h3>Vendors</h3>

        <form action="" method="POST">


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
                    </tr>


                </thead>

                <tbody>

                    <?php
                    while ($row2 = $retailers->fetch_assoc()) {




                    ?>


                        <tr>
                            <td>
                                <?php echo $row2['retailer_id']   ?>
                            </td>
                            <td>
                                <?php echo $row2['retailer_name']   ?>
                            </td>
                            <td>
                                <?php echo $row2['retailer_phone_number']   ?>
                            </td>
                            <td>
                                <?php echo $row2['retailer_address']   ?>
                            </td>
                            <td>
                                <?php echo $row2['retailer_location']   ?>
                            </td>
                            <td>
                                <button name="delete" value="<?php echo $row2['retailer_login_id']   ?>">Remove </button>
                            </td>
                        </tr>

                    <?php
                    }





                    ?>

                </tbody>




            </table>
        </form>



    </section>

    <div class="bottom">
        <a href="logout.php"> logout</a>
    </div>



    <section class=" footer ">
        <h4>About TOI </h4>
        <p>
            TOI Management sytems is an electronic systems that help second hand shoe retailer to be abl e to manage their stock
            <br>It also helps them track the purchases and sales of their products.
        </p>
        <div class=" icons ">
            <a href=" # " class=" fa fa-facebook "></a>
            <a href=" # " class=" fa fa-twitter "></a>
            <a href=" # " class=" fa fa-instagram "></a>
            <a href=" # " class=" fa fa-linkedin "></a>
        </div>
        <p>Made With<i class=" fa fa-heart-o ">by 2bit Solutions</i></p>


    </section>

</body>

</html>