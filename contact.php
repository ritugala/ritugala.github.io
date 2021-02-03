<?php
error_log("script was called, processing request...");
error_log("passed name is: " . $_POST["name"]);
if(isset($_POST)) {
    error_log("passed name is: " . $_POST["date"]);
    $name_ = "";
    $patient_email = "";
    $phone = "";
    $pain = "";
    $date_ = "";
    $comments = "";
     
    if(isset($_POST['name'])) {
        $name_ = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['email'])) {
        $patient_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $patient_email = filter_var($patient_email, FILTER_VALIDATE_EMAIL);
    }
     
    if(isset($_POST['phone'])) {
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    }
     
    if(isset($_POST['pain'])) { 
        
        $pain = filter_var(implode($_POST['pain']), FILTER_SANITIZE_STRING);
    }
     
    if(isset($_POST['comments'])) {
        $comments = htmlspecialchars($_POST['comments']);
    }

    if(isset($_POST['date'])){
        $date_ = preg_replace('#(\d{2})\s(\d{2})\s(\d{4})#', '$3-$2-$1', $_POST['date']);
    
    }
    echo("hello");

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "gnh";
    $conn = new mysqli($servername, $username, $password, $dbname);
   
    
    $sql = "INSERT INTO queries VALUES ('$name_', '$patient_email', '$phone', '$pain', '$date_', '$comments');" ;
    if($conn->query($sql)===FALSE)
        die("");
    
    $conn->close();

    $email_message = "Thank you for contacting Gala Nursing Home. Someone will be in touch with you shortly.";
    $subject = "Appointment/Comments Received for Gala Nursing Home";
    $gnh_email = "ritukhush@hotmail.com"   ;  
    
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $gnh_email . "\r\n";

    $appointment_details = "Patient Name: $name_ \n Area of Pain: $pain \n Appointment Date: $date_\n  Contact Details:\t phone: $phone email address: $patient_email ";
   
    error_log("email about to send");
    if(mail($patient_email, $subject, $email_message, $headers)) {
        error_log("email sent");
    } 
    else {
        die();
    }
    mail($gnh_email, "Appointment Recieved--", $appointment_details );
     
    } 

    
    
    
    //header("Location: index.html");
    
        
    




?>
