<?php
$from = "ritugala13@gmail.com";
$to = "ritugala13@gmail.com";
$subject = "Simple test for mail function";
$message = "This is a test to check if php mail function sends out the email";

if (mail($to, $subject, $body)) {
   echo("
      Message successfully sent!
   ");
} else {
   echo("
      Message delivery failed...
   ");
}
?>