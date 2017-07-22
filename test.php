<?php
$from = 'chientuan084@gmail.com';
$to = 'chienthcsphucduong@gmail.com';
$subject = 'Example 1: Send simple text email';
$message = 'A plain text email.';
$header = "From: $from\r\nReply-to: $from";
 
if ( mail($to, $subject, $message, $header) ) {
    echo "Email sent to $to!";
} else {
    echo "Error occured while sending email to $to!";
} //end if
?>