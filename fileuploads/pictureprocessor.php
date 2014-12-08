<?php
require_once "../config/config.php";
include_once '../user/control.php';
controlUser ();

if (isset ( $_FILES ['file'] )) {
	
	$email = $_SESSION ['email'];
	// Current folder
	$folder = str_replace ( basename ( $_SERVER ['PHP_SELF'] ), '', $_SERVER ['PHP_SELF'] );
	
	$uploadsFolder = $_SERVER ['DOCUMENT_ROOT'] . $folder . 'users/' . $email . '/';
	if (! file_exists ( $uploadsFolder )) {
		@mkdir ( $uploadsFolder );
		@chmod ( $uploadsFolder, 0777 );
	}
	
	// Input File element's name
	$inputFileName = 'file';
	
	// Check upload errors
	($_FILES [$inputFileName] ['error'] == 0) or die ( "<p id='errorupload'>Error: " . $_FILES [$inputFileName] ['error'] . "</p>" );
	
	// Check if file's sender is the form
	@is_uploaded_file ( $_FILES [$inputFileName] ['tmp_name'] ) or die ( "<p id='errorupload'> File is not upload. </p>" );
	
	// Check if uploaded file is an image. This function returns false if it's not.
	@getimagesize ( $_FILES [$inputFileName] ['tmp_name'] ) or die ( "<p id='errorupload'>You can only upload images (.PNG, .JPG, .BMP, etc.).</p>" );
	
	// Build an unique name for the image, e.g.: 1175219723-nombrefich.jpg
	$now = time ();
	while ( file_exists ( $uploadFilename = $uploadsFolder . $now . '-' . $_FILES [$inputFileName] ['name'] ) ) {
		$now ++;
	}
	
	// Place image
	@move_uploaded_file ( $_FILES [$inputFileName] ['tmp_name'], $uploadFilename ) or die ( "<p id='errorupload'>You have no permission for the directory.</p>" );
	
	connectdb ();
	// Update this user's picture in the database	
	$picture = $now . '-' . $_FILES [$inputFileName] ['name'];
	$querypicture = mysql_query ("UPDATE students SET picture='$picture' WHERE email='$email'");
	if (! $querypicture )
		die ( "<p id='errorupload'>Unable to insert the image into the database." );
	echo "<p id='message'>Picture uploaded! Redirecting...</p>";
} else
	echo "<p id='errorupload'>You have to choose a picture.</p>";
?> 