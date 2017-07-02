<?php

function AddAdminUser($current_date, $connection_string, $posted_data){

    $user_access = 'ADMIN';
    $user_status = 'ACTV';
    $hash = password_hash($password1, PASSWORD_BCRYPT);
    $current_date = date("Y-m-d h:m:s");
    $email = mysqli_real_escape_string($connection_string, $_POST['email']);
    
    $sql = "INSERT INTO UserAccess (UserName, UserPassword, UFirstName, ULastName, UserAccess, UserStatus)
VALUES ('$email', '$hash', '$first_name', '$last_name', '$user_access', '$user_status')";
  
    if (!mysqli_query($connection_string,$sql)) {
      die('Error: ' . mysqli_error($connection_string));
    }

}

?>