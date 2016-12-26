<?php

$connection_string = mysqli_connect("pullupachairindycom.ipagemysql.com","puac_root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `Stories`';
    
    if($result = mysqli_query($connection_string, $sql)){
        
     echo 'Success';
     
      }
  
    }else{
    
       die('Error: The connection failed' . mysqli_error($connection_string));
    }