<php

  $admin_email = "admin@pullupachairindy.com";
  $email = 'From: /usr/sbin/sendmail'."\r\n";
  $subject = 'Submission for Show';
  $body = 'Test';
  
  //send email
  mail($admin_email, "$subject", $body, "From:" . $email);
  
?>