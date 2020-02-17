<?php 
    if(isset($_POST['sendMail'])){
        $toemail = $_POST['emailtxt'];
        $subjectTitle = $_POST['subject'];
        $bdcontent = $_POST['msg']; 
        
    require_once 'PHPMailer/class.phpmailer.php'; 
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->CharSet = 'UTF-8'; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->Port = 587; 
    $mail->Username = 'your email id'; 
    $mail->Password = 'your Mail Password';
    $mail->SMTPAuth = true;
    $mail->From = 'your mail id'; 
    $mail->FromName = 'Kundan Kotangale'; 
    $mail->AddAddress($toemail); $mail->addreplyto('yourEmailID', 'Info'); 
   
    $mail->IsHTML(true);
    $mail->Subject = $subjectTitle; 
    $mail->AltBody = 'Server Alert mail!'; 
    $mail->Body = $bdcontent; 
    // echo $mail->Send(); 
    if (!$mail->Send()) {
         echo 'Mailer Error: '.$mail->ErrorInfo; return 0;
    } else {
        echo 'Email Message sent!'; return 1;
    } 
}
?>