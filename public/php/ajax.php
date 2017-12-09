<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use MongoDB\Client;
use MongoDB\Collection;

require_once 'functions.php';

$datetime = date( 'Y-m-d H:i:s' );

$client     = new Client( "mongodb://localhost:27017" );
$collection = $client->testtask->mails;

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
		foreach ( $mail_data['files'] as $file ) {
			$mail->addAttachment( $file );
		}
	}

	//Content
	$mail->isHTML( true );
	$mail->Subject = $mail_data['subject'];
	$mail->Body    = $mail_data['text'] . 'test';

	//Отправили
	$mail->send();

	// Записали в бд
	$result = $collection->insertOne(
		[
			'email'   => $mail_data['email'],
			'subject' => $mail_data['subject'],
			'text'    => $mail_data['text'],
			'created' => $datetime,
			'files' => [
				'test1',
				'test2',
				'test3',
			],
		]
	);


	echo 'Успешно отправлено';

} catch ( Exception $e ) {
	echo 'Не отправлено.';
	echo 'Ошибка: ' . $mail->ErrorInfo;
}
?>