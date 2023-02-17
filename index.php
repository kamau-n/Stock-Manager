<?php


$errors = array('email' => '', 'password' => '', 'not-exists' => '');
$usernames = $passwords = "";
include("./config/connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST['email']) and empty($_POST['password'])) {



        $errors['email'] = "username is empty";
        $errors['password'] = "password is empty";
    } else {



        $username = $_POST["username"];
        $password = $_POST["password"];




        $sql7 = "
select *
from login
where login_user_name='$username';

";
        $result = $conn->query($sql7);


        //
        if ($result->num_rows > 0) {

            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //comparing the passwords

                if (($password == $row["login_password"])  and $row['login_rank'] == "customer") {
                    $_SESSION['login_id'] = $row['login_id'];
                    header("Location: dashboard.php");
                } elseif ($password == $row["login_password"] and  $row["login_rank"] == "admin") {


                    $_SESSION['login_rank'] = "admin";
                    header("Location: portal.php");
                } else {


                    $errors['password'] = "passwords is incorrect";
                }
            }
        } else {
            $errors['not-exists'] = "user does not exist";
        }
        $conn->close();
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="static/styles/index.css">
</head>

<body>


    <div class="form">
        <form method="post" action="">
            <h2>WELCOME TO TOI MARKET</h2>
            <h3 class="heading">Login Below</h3>
            <div class="errors">
                <?php echo $errors['not-exists']  ?>
            </div>

            <input type="text" name="username" placeholder="Enter UserName">
            <div class="errors">
                <?php echo $errors['email']  ?>
            </div>


            <input type="password" name="password" placeholder="Enter Password Here">
            <div class="errors">
                <?php echo $errors['password']  ?>
            </div>
            <button type="submit" class="btnn">LOGIN </button>
            <div class="red">
                <a href="account.php">create an account</a>
            </div>


        </form>
    </div>





</body>

</html>