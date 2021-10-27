<?php

    include("connections.php");

   if(empty($_GET['search'])){
       echo "No entry";
   } else{

       $check = $_GET['search'];
       $q = "SELECT * FROM mytbl WHERE ";
       $i = 0;
       $terms = explode(" ", $check);

       foreach($terms as $each){
           $i++;
           
           if($i == 1){
                $q .= "name LIKE '%$each%' ";
             
           }else{
               $q .= "OR name LIKE '%$each%' ";
               
           }
   }
   $query = mysqli_query($connections, $q);
   $c_q = mysqli_num_rows($query);

  
   if($c_q > 0 && $check != ""){
        while($row = mysqli_fetch_assoc($query)){
            echo $name = $row['name'] . "<br>";
        }
   }else{
       echo "No result";
   }
   
}
   
?>