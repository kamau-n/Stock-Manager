<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

?>


<?php


include("config/connection.php");
include("Utilities/Functions.php");



//$errors = array('username'=>NULL,'password'=>NULL,'email'=>NULL,'address'=>NULL,'exists'=>NULL);
$errors = array();



//var_dump(isset($errors["password"]));

// to check if a person has clicked the submit button

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $filename = $_FILES["dp"]['name'];
    $tmp_name  = $_FILES['dp']['tmp_name'];
    $folder =  "uploads/" . $filename;






    if (check_empty($_FILES['dp'])) {
        $link = $filename;
    } else {
        $error["image"] = "The Picture has not been selected";
    }

    if (check_empty($_POST['name'])) {
        $name = $_POST["name"];
    } else {
        $errors['name'] = "name is  empty";
    }

    if (check_empty($_POST['description'])) {
        $description = $_POST["description"];
    } else {
        $errors['description'] = "description is  empty";
    }



    if (check_empty($_POST['price'])) {
        $price = $_POST["price"];
    } else {
        $errors['price'] = "price is empty";
    }

    if (check_empty($_POST['quantity'])) {
        $quantity = $_POST["quantity"];
    } else {
        $errors['quantity'] = "quantity  is empty";
    }


    if (check_empty($_POST['batch'])) {
        $batch = $_POST["batch"];
    } else {
        $errors['batch'] = "batch  is empty";
    }


    if (check_empty($_POST['retailer'])) {
        $retailer = $_POST["retailer"];
    } else {
        $errors['retailer'] = "retailer  is empty";
    }











    if (empty($errors)) {


        $sql = "INSERT INTO items (item_name,item_description) VALUES('$name','$description');";

        if ($conn->query($sql) === TRUE) {

            $item_id = mysqli_insert_id($conn);

            if (move_uploaded_file($tmp_name, $folder)) {

                $sql = "INSERT INTO retailer_item (retailer_item_price,retailer_items_quantity,retailer_items_batch_no,retailer_item_items_id,retailer_item_retailer_id,retailer_item_link) VALUES('$price','$quantity','$batch','$item_id','$retailer','$link') ";
                if ($conn->query($sql)) {

                    $sql = "INSERT INTO stock (Stock_Retailer_items_id,Stock_initial,Stock_sold,Stock_left) VALUES('$item_id',$quantity,0,'$quantity') ";
                    if ($conn->query($sql)) {

                        echo "<script>
                alert('item uploaded sucessfully');

                </script>";;
                    } else {
                        print $conn->error;
                        echo "<script>
                alert('there is an error uploading the image');

                </script>";;
                    }
                }
            } else {
                $error['image'] = "There is a problem uploading the  image check and try again";
                echo "<script>
                alert('there is an error uploading the image');

                </script>";;
            }
        } else {
            echo "<script>
                alert('there is an error uploading the image');

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
    <title>add products</title>
    <link rel="stylesheet" href="static/styles/portal.css">
    <style>

    </style>
</head>

<body>
    <div class="add-shoe">
        <form method="post" action="" enctype="multipart/form-data">
            <h2>add products </h2>
            <div class="errors">
                <?php echo $errors['exists']  ?>
            </div>

            <input type="text" name="name" placeholder="Enter the name here">
            <div class="errors">
                <?php echo $errors['name']  ?>
            </div>
            <input type="text" name="description" placeholder="Enter a bried descripton Here">
            <div class="errors">
                <?php echo $errors['description']  ?>
            </div>


            <input type="number" name="price" placeholder="Enter Price Here">
            <div class="errors">
                <?php echo $errors['price']  ?>
            </div>

            <input type="number" name="quantity" placeholder="Enter Item quantity">
            <div class="errors">
                <?php echo $errors['quantity']  ?>
            </div>

            <input type="number" name="batch" placeholder="Enter Item batch number">
            <div class="errors">
                <?php echo $errors['batch']  ?>
            </div>

            <input type="number" name="retailer" placeholder="Enter the retailer id">
            <div class="errors">
                <?php echo $errors['retailer']  ?>
            </div>

            <h4> Select an Image for your Product</h4>

            <input type="file" name="dp" value="dp" class="dp" placeholder="Select itemPicture" />
            <div class="errors">
                <?php echo $errors['image']  ?>
            </div>
            <input type="submit" value="add" />

        </form>
    </div>

    <div class="bottom">
        <a href="portal.php"> Go back Home</a>
    </div>



</body>

</html>