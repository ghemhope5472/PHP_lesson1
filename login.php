<style>
    .error{
        color: red;
    }
</style>
<?php
    $email = $password = '';
    $emailErr = $passwordErr = '';


    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        if(empty($_POST["email"])){
            $emailErr = "Required";
        }else{
            $email = $_POST['email'];
        }
        if(empty($_POST["password"])){
            $passwordErr = "Required";
        }else{
            $password = $_POST["password"];
        }
        if($email && $password){
            include("connections.php");

            $check_email = mysqli_query($connections, "SELECT * FROM mytbl where email='$email' ");
            $check_email_rows = mysqli_num_rows($check_email);
            if($check_email_rows > 0 ){
                    while($row = mysqli_fetch_assoc($check_email)){
                        $db_password = $row["password"];
                        $db_account_type = $row["account_type"];
                        if( $password === $db_password){
                            if( $db_account_type == "1"){
                                echo "<script>window.location.href='admin';</script>";
                            }else{
                                echo "<script>window.location.href='user';</script>";
                            }
                        }else{
                            $passwordErr = "Password is incorrect";
                        }
                    }

            }else{
                    $emailErr =  "Not registered";
            }

        }
    }
?>


<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

    <label for="email">Email </label> <br>
    <input type="text" name="email" ><br>
    <span class="error"> <?php echo $emailErr ?> </span><br>


    
    <label for="password">Password </label> <br>
    <input type="password" name="password" ><br>
    <span class="error"> <?php echo $passwordErr ?> </span><br>

    <Button type="submit"> Login </Button>

</form>