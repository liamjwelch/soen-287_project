
<?php
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set('Etc/UTC');

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

        //Email for new match
        function sendNewMatchEmail ($name, $email, $match)
        {
            $mail = new PHPMailer;

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPAuth = true;

            $mail->Username = 'higher.education.database@gmail.com';

            $mail->Password = '$soen287';

            $mail->setFrom('higher.education.database@gmail.com', 'N.A.H.E.D. Team');

            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            $mail->Subject = 'New Match Found!';
        
            $mail->Body = "Dear ".$name." ".",<br><br>You have a match with a University \"$match\"";
        
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<br>Message was sent Successfully!";
            }
        }

        //Email for match Deadline
        function sendMatchDeadlineEmail ($name, $email, $match, $deadline)
        {
            $mail = new PHPMailer;

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPAuth = true;

            $mail->Username = 'higher.education.database@gmail.com';

            $mail->Password = '$soen287';

            $mail->setFrom('higher.education.database@gmail.com', 'N.A.H.E.D. Team');

            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            $mail->Subject = 'Match Deadline Approaching!';
        
            $mail->Body = "Dear ".$name." ".",<br><br>The deadline for \"$match\" is $deadline";
        
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<br>Message was sent Successfully!";
            }
        }

        //Email for Account verification
        function sendAccountCreationEmail ($name, $email, $link)
        {
            $mail = new PHPMailer;

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPAuth = true;

            $mail->Username = 'higher.education.database@gmail.com';

            $mail->Password = '$soen287';

            $mail->setFrom('higher.education.database@gmail.com', 'N.A.H.E.D. Team');

            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            $mail->Subject = 'Account Created!';
        
            $mail->Body = "Dear ".$name." ".",<br><br>Thank you for creating an account at the North American Higher Education Database. Please click the following link to confirm your account.
            <br><br>Click here: $link<br><br>If this was not you please contact us at higher.education.database@gmail.com";
        
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<br>Message was sent Successfully!";
            }
        }
    
?>
