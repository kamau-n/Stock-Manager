<?php

$errors = "";
$name = $password = $location = $address = $contact = '';
include("config/connection.php");
include("Utilities/Functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {




    if (check_empty($_POST['name'])) {
        $name = $_POST["name"];
    } else {
        $error["name"] = "name is empty";
    }









    if (empty($_POST['name'] or $_POST['address'] or $_POST['location'] or $_POST['password'] or $_POST['contact'])) {
        $errors = "Some Values are empty";
    } else {


        $sql = "INSERT INTO login (login_user_name,login_password,login_rank) VALUES('$name','$password','customer')";
        $logged = $conn->query($sql);
        if ($logged) {
            $log_id = mysqli_insert_id($conn);


            $sql = "INSERT INTO customer (customer_name,customer_phone_number,customer_address,customer_location,customer_login_id) VALUES('$name','$contact','$address','$location','$log_id');";

            if ($conn->query($sql) === TRUE) {

                echo "<script>
                   alert('Account  registration sucessful');
                   window.location.href='index.php';
                  </script>";;
            } else {

                echo "<script>
                alert('account  registration unsucessful');

                </script>";;
            }
        } else {
            echo "<script>
            alert('account  registration unsucessful');

            </script>";;
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
    <link rel="stylesheet" href="static/styles/index.css">
    <title>create account</title>
</head>

<body>

    <div class="form">
        <form method="post" action="">
            <h2>WELCOME TO TOI MIS</h2>
            <h3 class="heading">Create Account Below</h3>
            <div class="errors">
                <?php echo $errors  ?>
            </div>

            <input type="text" name="name" placeholder="Enter your name">


            <input type="text" name="address" placeholder="Enter your address">

            <input type="text" name="contact" placeholder="Enter your phone number">


            <input type="text" name="location" placeholder="Enter your location">


            <input type="password" name="password" placeholder="Enter Password Here">

            <button type="submit" class="btnn">Register </button>
            <div class="red">
                <a href="index.php">login to account</a>
            </div>


        </form>
    </div>


</body>

</html>