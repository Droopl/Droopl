<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class CollectionController extends AppController{


	public $feedDAO;
	public $userDAO;

	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';

		$this->collectionDAO = new CollectionDAO();

	}

	public function remove(){

		if(isset($_GET) && !empty($_GET['action']) && $_GET['action'] == 'remove'){
				if(!empty($_GET['collection_id'])){
					$item = $this->collectionDAO->getCollectionById($_GET['collection_id']);

					if(isset($_SESSION['user'])){

						if($item['user_id'] == $_SESSION['user']['id']){
							$this->collectionDAO->removeItem($item['collection_id']);
						}
					}
				}
		}

	}

	public function update(){

		if(!empty($_GET['id'])){
			if(!empty($_POST) && !empty($_POST['item_name'])){

				$name = "";
				$description = "";
				$available = 0;
				$status = 0;

				if(!empty($_POST['item_name'])){
					$name = $_POST['item_name'];
				}

				if(!empty($_POST['item_description'])){
					$description = $_POST['item_description'];
				}

				if(!empty($_POST['item_availability'])){
					$available = $_POST['item_availability'];
				}

				if(!empty($_POST['item_privacy'])){
					$status = $_POST['item_privacy'];
				}

				$updated = $this->collectionDAO->updateItem($_GET['id'],$description,$name,$status,$available);

				echo boolval($updated);

				exit();

			}
		}else{
            echo boolval(false);
		}

	}

	public function item(){

		$item = array();

		if(!empty($_GET['action']) && $_GET['action'] == "box"){
			if(!empty($_GET['id'])){
				$item = $this->collectionDAO->getCollectionById($_GET['id']);
				if(empty($item)){
					$this->redirect("?page=feed");
				}
			}else{

				$this->redirect("?page=feed");
			}
		}else{
			$this->redirect("?page=feed");
		}

		$this->set("item",$item);

	}
    
    public function add(){

    	$item = "";
    	$description = "";


    	if(!empty($_SESSION['user'])){

			$user_id = $_SESSION['user']['id'];


			if(!empty($_POST)){

				if(!empty($_POST['item_name'])){
					$item = $_POST['item_name'];
				}
                
				if(!empty($_POST['item_description'])){
					$description = $_POST['item_description'];
				}	

				if(isset($_FILES['collection_image']) && $_FILES['collection_image']['size'] != 0){

					$max_file_size = 1024*1000; // 200kb
					$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
					// thumbnail sizes
					$sizes = array(200 => 200);

					if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['collection_image'])) {
					  if( $_FILES['collection_image']['size'] < $max_file_size ){
					    // get file extension
					    $ext = strtolower(pathinfo($_FILES['collection_image']['name'], PATHINFO_EXTENSION));
					    if (in_array($ext, $valid_exts)) {
					      /* resize image */
					      foreach ($sizes as $w => $h) {
					        $files[] = $this->resize($w, $h);
					      }

					      $addItem = $this->collectionDAO->addItem($item,$user_id,$description,$files[0]);

					    } else {
					      $msg = 'Unsupported file';
					    }
					  } else{
					    $msg = 'Please upload image smaller than 200KB';
					  }
					}

					$type = $_FILES['collection_image']['type'];
					$extention = ".png";
					if($type == "image/png"){
						$extention = ".png";
					}elseif ($type == "image/jpeg") {
						$extention = ".jpeg";
					}
					$randomname = $this->generateRandomString();

				    $banner = $randomname.$extention;

				    $path = WWW_ROOT . 'images' . DS .'collection'.DS.$banner;

				    move_uploaded_file($_FILES['collection_image']['tmp_name'],$path);

				    

				    if($addItem){
				    	$this->redirect('?page=user&id='.$user_id.'&filter=collection');
				    }

				}
			}


		}else{
				$this->redirect("?page=login");
		}

        
    }

    private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


	function resize($width, $height){
	  /* Get original image x y*/
	  list($w, $h) = getimagesize($_FILES['collection_image']['tmp_name']);
	  /* calculate new image size with ratio */
	  $ratio = max($width/$w, $height/$h);
	  $h = ceil($height / $ratio);
	  $x = ($w - $width / $ratio) / 2;
	  $w = ceil($width / $ratio);
	  /* new file name */

	  $randomname = $this->generateRandomString();

		$banner = $randomname.".jpg";

		$path = WWW_ROOT . 'images' . DS .'collection'.DS.$banner;
	  /* read binary data from image file */
	  $imgString = file_get_contents($_FILES['collection_image']['tmp_name']);
	  /* create image from string */
	  $image = imagecreatefromstring($imgString);
	  $tmp = imagecreatetruecolor($width, $height);
	  imagecopyresampled($tmp, $image,
	    0, 0,
	    $x, 0,
	    $width, $height,
	    $w, $h);
	  /* Save image */
	  switch ($_FILES['collection_image']['type']) {
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
	  return $banner;
	  /* cleanup memory */
	  imagedestroy($image);
	  imagedestroy($tmp);
	}

}


