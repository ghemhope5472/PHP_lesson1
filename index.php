<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Sample</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>

<?php
    include('nav.php');

?>

<?php 
    $name = $address = $email = '';
    $errName = $errAddress = $errEmail = '';

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(empty($_POST["name"])){
            $errName = "Name is required "; 
        }else{
            $name = $_POST["name"];
        }
        if(empty($_POST["address"])){
            $errAddress = "Address is required";
        }else{
            $address = $_POST["address"];
        }
        if(empty($_POST["email"])){
            $errEmail = "Email is required";
        }else{
            $email = $_POST["email"];
        }
    }

?>
<form action="<?php htmlspecialchars('PHP_SELF'); ?>" method="POST">

    <label for="name">Full name</label> <br>
    <input type="text" name="name" id="name" require> <br>
    <span class="error"> <?php echo $errName; ?> </span> <br>   

    <label for="address">Address</label> <br>
    <input type="text" name="address" id="address" require> <br>
    <span class="error"> <?php echo $errAddress; ?> </span> <br>

    <label for="email">Email</label> <br>
    <input type="email" name="email" id="email" require > <br>
    <span class="error"> <?php echo $errEmail; ?> </span> <br>

    <button type="submit"> Submit </button>

</form>
<hr>

<?php 
        include("connections.php");

       if($name && $address && $email){

        $query = mysqli_query( $connections, "INSERT INTO mytbl(name,address,email) VALUES('$name','$address','$email')");
        echo "<script language='javascript'> alert('New record inserted to database!');</script>";
        echo "<script> window.href.location='index.php';</script>";

       }

        $view_query = mysqli_query($connections, "SELECT * FROM mytbl");

        echo "<table border='1' width='50%'>";
        echo "<tr> 
                    <td> Name </td>
                    <td> Email </td>
                    <td> Address </td>
                    <td colspan='2'> Option </td>
        
            </tr>";

        while($row = mysqli_fetch_assoc($view_query)){
                $user_id = $row['id'];
                $db_name = $row["name"];
                $db_address = $row["address"];
                $db_email = $row["email"];

                echo "<tr> 
                        <td> $db_name</td>
                        <td> $db_email </td>
                        <td> $db_address </td>
                        <td> <a href='Edit.php?id=$user_id'> Update </a> </td>
                        <td> <a href='confirmDelete.php?id=$user_id'> Delete </a> </td>
                    </tr>";
        }



        echo "</table>";
        

?>



</body>
</html>