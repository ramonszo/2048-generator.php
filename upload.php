<?php
$prettyError = '<script>alert("An error occurred while processing your image. Try again.");</script>';	

if(!(int)$_POST['tile-num']){
	echo $prettyError;
	exit();
}

$filename = sha1(sha1(time().uniqid().md5(rand())).uniqid());
$thumbfile = uploadpic(false, 'images/'.$filename.'.jpg', 'tile-img', 107);

if(!$thumbfile){
	echo $prettyError;
	exit();
} else {
	echo '<script>parent.uploadSuccess("'.(int)$_POST['tile-num'].'", "'.$filename.'");</script>';
	exit();
}

function uploadpic($file,$thumb_file,$field,$thumb_width=100){
	$result=false;

	if(is_uploaded_file($_FILES[$field]['tmp_name']))
		{
			//move_uploaded_file($_FILES[$field]['tmp_name'],$file);
			resize($_FILES[$field]['tmp_name'],$thumb_file,$thumb_width);
			$result=true;
		}
	return $result;
}

function resize($orig_file,$thumb_file,$prop){
	$img = $orig_file;
	$constrain = true;
	$w = $prop;
	$h = $prop;
	
	// get image size of img
	$x = @getimagesize($img);
	// image width
	$sw = $x[0];
	// image height
	$sh = $x[1];

	if($sw > $sh){
	    $ratio = $sw/$sh;
	    $h = $prop;
	    $w = round($prop * $ratio);
	} else  {
	    $ratio = $sh/$sw;
	    $w = $prop;
	    $h = round($prop * $ratio);
	}
	
	$im = @ImageCreateFromJPEG ($img) or // Read JPEG Image
	$im = @ImageCreateFromPNG ($img) or // or PNG Image
	$im = @ImageCreateFromGIF ($img) or // or GIF Image
	$im = false; // If image is not JPEG, PNG, or GIF
	
	if (!$im) {
		// We get errors from PHP's ImageCreate functions...
		// So let's echo back the contents of the actual image.
		readfile ($img);
	} else {
		// Create the resized image destination
		$thumb = @ImageCreateTrueColor ($w, $h);
		// Copy from image source, resize it, and paste to image destination
		@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		// Output resized image
		@ImageJPEG ($thumb,$thumb_file);
	}
}
?>