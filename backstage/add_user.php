<?php

/********** INCLUDES *********/

include_once("connection_string.php");


/********** CHECK FOR POSTED ***********/

if(isset($_POST["posted"])){




/********** DEFINE VARIABLES FROM POST **********/


  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if($password1 != $password2){
  
    $error = "Passwords do no match!";
    
  }

  if($_POST['first_name'] != ""){
  
    $first_name = mysqli_real_escape_string($connection_string, $_POST['first_name']);
    
    }

    else{
    
    $error = $error."</br>Please enter your first name.";
    
  }

  if($_POST['last_name'] != ""){
  
    $last_name = mysqli_real_escape_string($connection_string, $_POST['last_name']);
    
    }

    else{
    
    $error = $error."</br>Please enter your first name.";
    
  }

  if(!$error){

    $user_access = 'ADMIN';
    $user_status = 'ACTV';
    $hash = password_hash($password1, PASSWORD_BCRYPT);
    
    echo $hash;
    die;
    
    $current_date = date("Y-m-d h:m:s");
    $email = mysqli_real_escape_string($connection_string, $_POST['email']);
    
    $sql = "INSERT INTO UserAccess (UserName, UserPassword, UFirstName, ULastName, UserAccess, UserStatus)
VALUES ('$email', '$hash', '$first_name', '$last_name', '$user_access', '$user_status')";
  
    if (!mysqli_query($connection_string,$sql)) {
      die('Error: ' . mysqli_error($connection_string));
    }
  
    $record_number = mysqli_insert_id($connection_string);
    mysqli_close($link);
    header('Location: http://www.indysteampunk.com/sign_up.php?id='.$record_number);

  }
  
  else{
  
    echo "Error: ".$error;
    
  }

}

else {

echo "Fail!";

}

?>