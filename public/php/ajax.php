<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use MongoDB\Client;

require_once 'functions.php';

$datetime = date( 'Y-m-d H:i:s' );

$client     = new Client( "mongodb://localhost:27017" );
$collection = $client->testtask->mails;

$mail_data            = [];
$mail_data['email']   = htmlspecialchars( $_POST['mailEmail'] );
$mail_data['subject'] = htmlspecialchars( $_POST['mailSubject'] );
$mail_data['text']    = htmlspecialchars( $_POST['mailText'] );
$mail_data['files']   = htmlspecialchars( $_POST['mailFiles'] );

if ( $mail_data['email'] && $mail_data['subject'] && $mail_data['text']){

	$mail = new PHPMailer( true );

	try {

		//Server settings
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->SMTPOptions = [
			'ssl' => [
				'verify_peer'       => false,
				'verify_peer_name'  => false,
				'allow_self_signed' => true
			]
		];
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
			$files = explode( ",", $mail_data['files'] );
			foreach ( $files as $file ) {
				$mail->addAttachment( realpath( '../files' ) . DIRECTORY_SEPARATOR . $file );
			}
		}

		//Content
		$mail->isHTML( true );
		$mail->Subject = $mail_data['subject'];
		$mail->Body    = html_entity_decode( $mail_data['text'] );

		//Отправили
		$mail->send();
		$sent = 1;
		// Записали в бд
		echo 'Успешно отправлено';

	} catch ( Exception $e ) {
		echo 'Не отправлено.';
		echo 'Ошибка: ' . $mail->ErrorInfo;
		$sent = 0;
	}


	$result = $collection->insertOne(
		[
			'email'   => $mail_data['email'],
			'subject' => $mail_data['subject'],
			'text'    => $mail_data['text'],
			'created' => $datetime,
			'sent'    => $sent,
			'files'   => [
				explode(",",$mail_data['files'])
			],
		]
	);

}
?>