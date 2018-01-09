<?php

function LoginForm($error_message){
  echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
  echo '<h1>Login</h1>';
  echo '<p class="label"><label for="email">Username</label> <input name="email" type="text"></p>';
  echo '<p class="label"><label for="password">Password</label> <input name="password" type="password"></p>';
  echo '<input type="hidden" name="a" value="login">';
  echo '<input name="posted" type="hidden" value="posted"></p>'; 
// Print Error Text if it exists
  if(ISSET($error_message)){
    echo $error_message;  
  }
  echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit"></p>';
  echo '</form>';
}


// DEFINE USER OBJECT

  class User {
    
      var $user_id;
      var $sign_in;
      var $first_name;
      var $last_name;
      var $hash;
      var $access;
      var $status;
      var $date_added;
      var $date_updated;
    
    public function set_name($row){
      $this->user_id      = $row['UserID'];
      $this->sign_in      = $row['UserName'];
      $this->first_name   = $row['UFirstName'];
      $this->last_name    = $row['ULastName'];
      $this->hash         = $row['UserPassword'];
      $this->access       = $row['UserAccess'];
      $this->status       = $row['UserStatus'];
      $this->date_added   = $row['UDateAdded'];
      $this->date_updated = $row['UDateModified'];

    }

  //ADD ADMIN USER
    public function AddAdminUser($current_date, $connection_string, $posted_data){
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

  //ADD NEW USER FROM SUBMISSON
    public function AddUserSubmission($connection_string, $submission){
      $user_access = 'PRFM';
      $user_status = 'NEW';
      $current_date = date("Y-m-d h:m:s");
     
      $sql = "SELECT * FROM `UserAccess` WHERE `UserName` LIKE '".$submission['email']."'";
        if (!mysqli_query($connection_string,$sql)){
          die('Error: ' . mysqli_error($connection_string));
        }
        else{
          $result = mysqli_query($connection_string, $sql);
          if(mysqli_num_rows($result) == 0){
          $email      = stripslashes($submission['email']);
          $first_name = stripslashes($submission['first_name']);
          $last_name  = stripslashes($submission['last_name']);
          $password   = 'new';

          $sql = "INSERT INTO UserAccess (UserName, UFirstName, ULastName, UserAccess, UserStatus, UserPassword)
                  VALUES ('$email', '$first_name', '$last_name', '$user_access', '$user_status', '$password')";
          if (!mysqli_query($connection_string,$sql)) {
            die('Error: ' . mysqli_error($connection_string));
          }
          $last_id = mysqli_insert_id($connection_string);
          $width = 10;
          $padded = str_pad((string)$last_id, $width, "0", STR_PAD_LEFT); 
          return $padded;
        }
      }
  }

  //VERIFY PASSWORD AND SIGN IN
    public function CheckPassword($connection_string, $email, $pass){
          
      $sql = 'SELECT * FROM `UserAccess` WHERE `UserName` = "'.$email.'"';
    
      if($result = mysqli_query($connection_string, $sql)){
    
        while($row = mysqli_fetch_array($result)){
          $hash           = $row['UserPassword'];
          $first_name     = stripslashes($row['UFirstName']);
          $last_name      = stripslashes($row['ULastName']);
          $UserAccess     = stripslashes($row['UserAccess']);
          $UserID         = stripslashes($row['UserID']);
            
          if (password_verify($pass, $hash)) {
        
            $_SESSION["FirstName"]   = $first_name;
            $_SESSION["LastName"]    = $last_name;
            $_SESSION["UserAccess"]  = $UserAccess;
            $_SESSION["u"]           = $UserID;
 
            setcookie("name", $first_name);
            header('Location:home.php');    
         }
         else{
           $error_message = "Incorrect username and password"; 
        }
      }
    }
    
  }
      
  //PASSWORD RESET FORM
    public function PasswordForm($connection_string, $uid){
      $sql = 'SELECT * FROM `UserAccess` WHERE `UserID` = '.$uid;
    
      if($result = mysqli_query($connection_string, $sql)){    
        if(mysqli_num_rows($result) == 1){
          while($row = mysqli_fetch_array($result)){
            $user = new User;
            $user->set_name($row);
            if($this->hash = "New"){
              echo '<p>Hello, '.$user->first_name.' '.$user->last_name.' you have submitted a story for the Pull Up a Chair show.  Please use the form below to create access your account and complete your performer profile.</p>';
              echo '<p>Create Password</p>';
            }
            else{
              echo '<p>Reset Password</p>';
            }
            echo '<form name="password_reset" action='.$_SERVER['PHP_SELF'].' method="POST">';
            echo '<label for "email">Email: </label>'.$user-> sign_in.'<br />';
            echo '<label for "pass1">Password: </label><input type="password" name="pass1"><br />';
            echo '<label for "pass2">Verify: </label><input type="password" name="pass2"><br />';
            echo '<input type="hidden" name="a" value="SetPassword">';
            echo '<input type="hidden" name="u" value="'.$user->user_id.'">';
            echo '<input type="submit">';
          }

        }

      }
  }





  //Reset User Password
    public function ResetPassword($connection_string, $uid, $pass1, $pass2){
      if($pass1 == $pass2){
        $hash         = password_hash($pass1, PASSWORD_BCRYPT);
        $date_updated = date("Y-m-d h:m:s");          
        $sql = "UPDATE `UserAccess`
                SET `UserPassword` = '$hash',
               `UserStatus` = 'ACTV' 
                WHERE `UserAccess`.`UserID` = '$uid';";
        if (!mysqli_query($connection_string,$sql)){
          die('Error: ' . mysqli_error($connection_string));
        }
        header('Location:login.php');    
      }
      
  }






//SET THE PERFORMER FULL NAME
    public function PerformerName(){
      $performer_name = $this->first_name.' '.$this->last_name;
      return $performer_name;
    }
  }

  class Performer extends User {
    
    var $first_name;
    var $last_name;
    var $sign_in;
    var $hash;
    var $status;
    var $access;
    
    public function set_name($row){
      $this->first_name = $row['UFirstName'];
      $this->last_name  = $row['ULastName'];
      $this->sign_in    = $row['UserName'];
      $this->hash       = $row['UserPassword'];
      $this->status     = $row['UserStatus'];
      $this->access     = $row['UserAccess'];
    }

    public function PerformerName(){
      $performer_name = $this->first_name.' '.$this->last_name;
      return $performer_name;
    }
  }

?>