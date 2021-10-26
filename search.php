

<?php

        $search = $searchErr = '';

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $searchErr = 'Required';
        } else {
            $search = $_POST['search'];
        }

        if($search){
            echo "<script>windows.location.href='result.php?search=$search</script>";
        }

?>


<style>
    .error{
        color:red;
    }
</style>


<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <input type="text" name="search" value="<?php echo $search; ?>"> <br>
    <span class="error"> <?php echo $searchErr; ?> </span> <br>
    <input type="submit" value="Search">

</form>