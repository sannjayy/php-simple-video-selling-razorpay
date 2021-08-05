<?PHP
error_reporting(1); 

include_once 'dbconnection.php';
$link = Db_Connect();
include_once 'common_function.php';

// Mailer
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
// End Mailer

@date_default_timezone_set('Asia/Kolkata');
session_start();


// Mailer
function mail_send($to_name,$to_email,$subject,$message){
		$mail = new PHPMailer();

		// HOST CONFIG 
        $host_email = SMTP_EMAIL;
        $host_name = SMTP_EMAIL_NAME;
        $reply_email = SMTP_EMAIL;
        $reply_name = SMTP_EMAIL_NAME;

        //SMTP Settings
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USR;
        $mail->Password = SMTP_PSW;
        $mail->Port = SMTP_PRT; // 587 & 465
        $mail->SMTPSecure = SMTP_SCR; // tls & ssl

        //Recipients
        $mail->setFrom($host_email,$host_name);
        $mail->addAddress($to_email, $to_name);     // Add a recipient
        $mail->addReplyTo($reply_email, $reply_name);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients, try with another browser.';

        if ($mail->send()) {
            return "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            return "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
}
// Mailer END

?>
