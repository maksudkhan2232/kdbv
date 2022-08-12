$msg = "";
		    $msg .= '<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
			<table class="body-wrap" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
			<td class="container" width="600" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
				<div class="content" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
					<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="alert alert-warning" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #06aff0; margin: 0; padding: 20px;" align="center" bgcolor="#2f353f" valign="top">
						<h3  style="font-family:verdana">'.ucwords($hospitalname['firm_name']).'</h3>
						<p style="font-family:arial">'.$hospitalname['address'].'&nbsp;-&nbsp;'.$hospitalname['pincode'].'&nbsp;&nbsp;Mo.'.$hospitalname['mobileno'].'</p>

					</td>
				</tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
				<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
					You have <strong style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"> successfully</strong> registered.
				</td>
					</tr>
					<tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
						We Welcomes you :
					</td>
				</tr>
				<tr>
					<td>
				<table width="100%" cellpadding="5" cellspacing="2" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">
					<tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td><strong style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">Name</strong></td>
						<td>'.$personal_title.' '.ucfirst($fname).' '.ucfirst($lname).'</td>
					</tr>
					<tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td><strong style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">Username</strong></td>
						<td>'.$username.'</td>
					</tr>
					<tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">
						<td><strong style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;">Password</strong></td>
						<td>'.$password.'</td>
					</tr>
						</table><br></td>
					</tr>
					<tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top" align="center">
						<a href="'.BASE_URL.'" target="_blank" class="btn-primary" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #f5707a; margin: 0; border-color: #f5707a; border-style: solid; border-width: 10px 20px;">Login Now</a>
					</td>
				</tr><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
				Thanks For Joining Us. Please Login using this link with username and password.
				</td>
				</tr></table></td>
				</tr></table><div class="footer" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
				<table width="100%" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">All rights reserved <a href="'.BASE_URL.'" target="_blank" style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">E-Clinic</a>.</td>
				</tr></table></div></div>
				</td>
				<td style="font-family: Helvetica Neue; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
				</tr></table>
				</body>';
function sendMail_by_owner($email,$msg,$subject)
{
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = CON_EMAIL_HOST;                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = CON_EMAIL_USERNAME;     // SMTP username - Insert Email Address
    $mail->Password = CON_EMAIL_PASSWORD;          // SMTP password - Insert Email Account Password
    //$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
    //$mail->Port = 465; 
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect to  587 / 465
    //$mail->SMTPDebug = 3;
    $mail->setFrom(CON_EMAIL_FROM, 'E-Clinic');
    $mail->addReplyTo(CON_EMAIL_FROM, 'E-Clinic');
    //$mail->addAddress('sanskartechnolabpvtltd@gmail.com');
    $mail->addAddress($email);        // Add a recipient
    //$mail->addCC('viraj_iol@yahoo.co.in');
    //$mail->addBCC('bcc@example.com');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);  // Set email format to HTML
    $bodyContent = $msg;
    $mail->Subject = $subject;
    $mail->Body    = $bodyContent;
    if(!$mail->send($headers)) {
   //   echo 'Message could not be sent. ';
   //   echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      //echo 'Message has been sent';
    }
   return true; 
}


https://www.cluemediator.com/load-more-data-from-the-database-using-ajax-jquery-in-php-with-mysql#preview