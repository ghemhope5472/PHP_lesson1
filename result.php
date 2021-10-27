<?php

    include("connections.php");

   if(empty($_GET['search'])){
       echo "No entry";
   } else{
       $check = $_GET['search'];

       $terms = explode(' ', $check);
       foreach($terms as $each){
           echo $each . "<br>";
       }

   }

?>