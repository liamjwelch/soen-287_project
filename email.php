
<?php
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set('Etc/UTC');

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';


function sendEmail($destEmail, $destName, $subject, $content) {
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;

    $mail->Username = 'higher.education.database@gmail.com';
    $mail->Password = '$soen287';
    $mail->setFrom('higher.education.database@gmail.com', 'NAHED Team');

    $mail->addAddress($destEmail, $destName);

    $mail->isHTML(true);
    $mail->Subject = $subject;

    $mail->Body = $content;

    if (!$mail->send()) {
        throw new Exception("Error when sending email to $destEmail: $mail->ErrorInfo");
    }
}

function sendNewMatchEmail ($name, $email, $university) {
    $subject = 'New Match Found!';
    $content = "Dear $name,<br><br>You matched with $university!<br><br>Log in to your account to learn more!
                <br><br>The NAHED team";
    sendEmail($email, $name, $subject, $content);
}

function sendMatchDeadlineEmail ($name, $email, $university, $deadline) {
    $subject = 'Match Deadline Approaching!';
    $content = "Dear $name,<br><br>The application deadline for $university is $deadline.<br>Don't forget to apply
                before the deadline by loging-in in your account!<br><br>The NAHED team";
    sendEmail($email, $name, $subject, $content);
}

function sendAccountCreationEmail ($name, $email, $link) {
    $subject = 'Complete the creation of your account';

    $content = "Dear $name,<br><br>Thank you for creating an account at the North American Higher Education Database.
                Please click the following link to finish the creation of your account:<br><br><a href='$link'>$link</a>
                <br><br>The NAHED team";

    sendEmail($email, $name, $subject, $content);
}
