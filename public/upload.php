<?php


$storeFolder = 'files';


if ( ! empty( $_FILES ) ) { // Проверяем пришли ли файлы от клиента

	$tempFile = $_FILES['file']['tmp_name']; //Получаем загруженные файлы из временного хранилища

	$filename = $storeFolder.'/'. $_FILES['file']['name'];

	move_uploaded_file( $tempFile, $filename ); // Перемещаем загруженные файлы из временного хранилища в нашу папку uploads
} else {
	$result = array();

	$files = scandir( $storeFolder );
	if ( false !== $files ) {
		foreach ( $files as $file ) {
			if ( '.' != $file && '..' != $file ) {
				$obj['name'] = $file;
				$obj['size'] = filesize( $storeFolder . $ds . $file );
				$result[]    = $obj;
			}
		}
	}

	header( 'Content-type: text/json' );
	header( 'Content-type: application/json' );
	echo json_encode( $result );
}

?>