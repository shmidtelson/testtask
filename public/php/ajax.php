<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once 'functions.php';

$mail_data            = [];
$mail_data['email']   = htmlspecialchars( $_POST['mailEmail'] );
$mail_data['subject'] = htmlspecialchars( $_POST['mailSubject'] );
$mail_data['text']    = htmlspecialchars( $_POST['mailText'] );
$mail_data['files']   = htmlspecialchars( $_POST['mailFiles'] );


$mail = new PHPMailer( true );

try {

	//Server settings
//	$mail->SMTPDebug = 4;
	$mail->isSMTP();
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer'       => false,
			'verify_peer_name'  => false,
			'allow_self_signed' => true
		)
	);
	$mail->Host        = $config['smtp_server'];  //
	$mail->SMTPAuth    = true;
	$mail->Username    = $config['smtp_user'];
	$mail->Password    = $config['smtp_pass'];
	$mail->SMTPSecure  = $config['smtp_secure'];
	$mail->Port        = $config['smtp_port'];
	$mail->CharSet     = 'utf-8';

	$mail->setFrom( $config['smtp_user'], 'Отправитель' );

	$mail->addAddress( $mail_data['email'] );

	//Attachments
	if ( $mail_data['files'] ) {
		foreach ( $mail_data['files'] as $file ) {
			$mail->addAttachment( $file );
		}
	}

	//Content
	$mail->isHTML( true );
	$mail->Subject = $mail_data['subject'];
	$mail->Body    = $mail_data['text'];

	$mail->send();
	echo 'Успешно отправлено';

} catch ( Exception $e ) {
	echo 'Не отправлено.';
	echo 'Ошибка: ' . $mail->ErrorInfo;
}
?>