<?php

    $site_owners_email = 'geo@arshid.com'; // Replace this with your own email address
    $site_owners_name = 'Arshid'; // replace with your name
	
	
	$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
	$tel = filter_var( $_POST['tel'], FILTER_SANITIZE_STRING );
	// $date = filter_var( $_POST['date'], FILTER_SANITIZE_STRING );
	// $time = filter_var( $_POST['time'], FILTER_SANITIZE_STRING );

	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	// $subject = filter_var( $_POST['services'], FILTER_SANITIZE_STRING );
	$message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING );

	$isSubmitTypeAjax = filter_var( $_POST['submitType'], FILTER_SANITIZE_STRING );
	
	
	$nameText = '';
	$telText = '';
	$emailText = '';
	$serviceText = '';
	$footerText = '<br/><br/><div style="font-size: 12px;">This email is submitted form: ' . (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER[HTTP_HOST] . '</div>';
	
	
	if ( !empty($name) ) {
		$nameText .= '<b>Name:</b> ' . $name . '<br/>';
	}
	
	if ( !empty($tel) ) {
		$telText .= '<b>Telephone:</b> ' . $tel . '<br/>';
	}
	
	if ( !empty($email) ) {
		$emailText .= '<b>E-mail:</b> ' . $email . '<br/>';
	}
	if ( !empty($services) ) {
		$serviceText .= '<b>Services:</b> ' . $services . '<br/>';
	}
	
	if ( !empty($isSubmitTypeAjax) ) {
		require_once('phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();
		
		$mail->From = $email;
		$mail->FromName = $name;
		// $mail->Subject = $subject;

		$mail->AddAddress($site_owners_email, $site_owners_name);
		$mail->IsHTML(true);
		
		$mail->Body = $nameText . $telText . $emailText . $serviceText. '<br/>' . $message . $footerText;
			
		if ( isset( $_FILES['file'] ) && $_FILES['file']['error'] == UPLOAD_ERR_OK ) {
			$mail->AddAttachment( $_FILES['file']['tmp_name'], $_FILES['file']['name'] );
		}
		
		$mail->Send();
		
		
		echo '<div class="alert alert-success"  role="alert">Thank you. Your message has been sent.</div>';
	} else {
		// do nothing...
	}

?>
