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
    include("connections.php");
    $name = $address = $email = $password = $cpassword =  '';
    $errName = $errAddress = $errEmail = $errpassword = $errcpassword ='';

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
        if(empty($_POST['password'])){
            $errpassword = "Required";
        }else{
            $password = $_POST['password'];
        }
        if(empty($_POST['cpassword'])){
            $errcpassword = "Required";
        }else{
            $cpassword = $_POST['cpassword'];
        }
        if($name && $address && $email && $password && $cpassword ){
 
         $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email='$email' ");
         $check_email_row = mysqli_num_rows($check_email);
 
         if($check_email_row > 0 ){
             $errEmail = 'Already registered';
 
         }else{
             $query = mysqli_query($connections, " INSERT INTO mytbl(name,address,email,password,account_type)
             VALUES('$name','$address','$email','$password','2')");

             echo "<script language=javascript>alert('New record inserted');</script>";
             echo "<script>window.location.href='index.php'</script>";
         }
         
        
 
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

    <label for="email">Password</label> <br>
    <input type="password" name="password" require > <br>
    <span class="error"> <?php echo $errpassword; ?> </span> <br>

    <label for="email">Confirm Password</label> <br>
    <input type="password" name="cpassword" require > <br>
    <span class="error"> <?php echo $errcpassword; ?> </span> <br>

    <button type="submit"> Submit </button>

</form>
<hr>

<?php 
        include("connections.php");

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