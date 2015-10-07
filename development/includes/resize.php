<?php


	function resize($width, $height){
	  /* Get original image x y*/
	  list($w, $h) = getimagesize($_FILES['quest_image_upload']['tmp_name']);
	  /* calculate new image size with ratio */
	  $ratio = max($width/$w, $height/$h);
	  $h = ceil($height / $ratio);
	  $x = ($w - $width / $ratio) / 2;
	  $w = ceil($width / $ratio);
	  /* new file name */
	  $randomname = $this->generateRandomString();

		$banner = $randomname."jpg";

		$path = WWW_ROOT . 'questimages' . DS .'images'.DS.$banner;
	  /* read binary data from image file */
	  $imgString = file_get_contents($_FILES['quest_image_upload']['tmp_name']);
	  /* create image from string */
	  $image = imagecreatefromstring($imgString);
	  $tmp = imagecreatetruecolor($width, $height);
	  imagecopyresampled($tmp, $image,
	    0, 0,
	    $x, 0,
	    $width, $height,
	    $w, $h);
	  /* Save image */
	  switch ($_FILES['quest_image_upload']['type']) {
	    case 'image/jpeg':
	      imagejpeg($tmp, $path, 100);
	      break;
	    case 'image/png':
	      imagepng($tmp, $path, 0);
	      break;
	    case 'image/gif':
	      imagegif($tmp, $path);
	      break;
	    default:
	      exit;
	      break;
	  }
	  return $path;
	  /* cleanup memory */
	  imagedestroy($image);
	  imagedestroy($tmp);

	$this->imagesDAO->addImage($submition['quest_id'],$banner);
	}
