<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
include '/opt/lampp/htdocs/cwkeerthan/MinorProject/Sports/adminpage.php';

// $nameOfServer = "localhost";
// $username = "root";
// $password = "";
// $dbname = "responseform";

// $connect=mysqli_connect($nameOfServer,$username,$password,$dbname);
// if($connect)
// { 
// echo "connection done";
// }
// else
// {
// 	echo "no connection".mysqli_connect_error();
// }


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('');
    // $mail->addAddress('');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // echo $search;
    // $sql="select email from 'form' where area = $search";
    $res=mysqli_query($connect,$sql1);
    // echo mysqli_num_rows($res);
    if(mysqli_num_rows($res)>0){
        // echo "hi";

        $mail->addReplyTo('');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
        while($x=mysqli_fetch_assoc($res)){
            $mail->addBCC($x['email']);
        }
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the multi user email';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   if($mail->send()){
    echo 'Message has been sent';
       }    }
}
    catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    

    
