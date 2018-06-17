<?php
$to      = 'grafixgeek@yahoo.com';
$subject = 'Hello from Pull Up a Chair';
$message = "This is a message<br />
            Just testing the mail function.\n";
$headers = 'From: admin@pullupachair.com' . "\r\n" .
    'Reply-To: admin@pullupachair.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion().
    'MIME-Version: 1.0'."\r\n".
    'Content-Type: text/html; charset=ISO-8859-1'."\r\n";

mail($to, $subject, $message, $headers);
?>