<?php

$errors = "";
$name  = $location = $address = $contact = '';
include("/config/connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['name']) or empty($_POST['address']) or empty($_POST['location']) or empty($_POST['contact'])) {
        $errors = " * some Values are empty";
    } else {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $location = $_POST['location'];
        $contact = $_POST['contact'];

        $sql = "INSERT INTO login (login_user_name,login_password,login_rank) VALUES('$name',1234,'vendor')";
        $logged = $conn->query($sql);
        if ($logged) {
            $log_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO retailer (retailer_name,retailer_phone_number,retailer_address,retailer_location,retailer_login_id) VALUES('$name','$contact','$address','$location','$log_id')";
            if ($conn->query($sql)) {
                print "
                <script>
                alert('Vendor Added Successfully');
    
                </script>
                ";
            } else {
                print $conn->error;
                print "
                <script>
                alert('an error has occured');
    
                </script>
                ";
            }
        } else {
            print $conn->error;
            print "
            <script>
            alert('an error has occured');

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
    <title>Add Vendor</title>
    <link rel="stylesheet" href="static/styles/portal.css">
</head>

<body>
    <h2>Add A Vendor</h2>
    <form action="" method="POST" class="add-shoe">
        <span class="errors"><?php echo $errors  ?></span>
        <input type="text" name="name" placeholder="Enter the name of the vendor">
        <input type="text" name="contact" placeholder="Enter the Phone Number of the Vendor">
        <input type="text" name="address" placeholder="Enter the Address of the Vendor">
        <input type="text" name="location" placeholder="Enter the Location of the Vendor">

        <div class="tx">
            <button type="submit" class="btn">Add</button>
        </div>


    </form>
    <div class="bottom">
        <a href="portal.php"> Go back Home</a>
    </div>


</body>

</html>