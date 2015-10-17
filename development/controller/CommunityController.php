<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class CommunityController extends AppController{


	public $feedDAO;
	public $userDAO;

	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'FeedDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'OfferDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'PropoDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'ImagesDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'UserDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CommunityDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';

		$this->feedDAO = new FeedDAO();
		$this->offerDAO = new OfferDAO();
		$this->propoDAO = new PropoDAO();
		$this->imagesDAO = new ImagesDAO();
		$this->userDAO = new UserDAO();
		$this->communityDAO = new CommunityDAO();
		$this->collectionDAO = new CollectionDAO();

	}

	public function community(){

		$item = "";
		$user_id = "";
		$quest_description = "";
		$type = 0;
		$active = true;
		$quests = [];
		$image = "";

		$community = [];
		$users = [];
        $collection = [];
        $isMember = false;

        if(!empty($_GET['id'])){
        	$community = $this->communityDAO->getCommunityById($_GET['id']);
        	$users = $this->communityDAO->getCommunityUsersById($community['id']);

			if(isset($_SESSION['user'])){
	            $collection = $this->collectionDAO->getCollectionByUserId($_SESSION['user']['id']);
	            $checkMember = $this->communityDAO->isMemberOfCommunity($_SESSION['user']['id'],$_GET['id']);
	            if(!empty($checkMember)){
	            	$isMember = true;
	            }
			}

			if(!empty($_GET['action'])){

				if($_GET['action'] == "join"){

					if(!$isMember){
						if($this->communityDAO->addCommuntyUser($_SESSION['user']['id'],$_GET['id'])){
							$this->redirect("?page=community&id=".$_GET['id']);
						}
					}else{
						$this->redirect("?page=community&id=".$_GET['id']);
					}
				}else if($_GET['action'] == "leave"){
					if($isMember){
						if($this->communityDAO->leaveMember($_SESSION['user']['id'],$_GET['id'])){
							$this->redirect("?page=community&id=".$_GET['id']);
						}
					}
				}

			}
			

			if(!empty($_SESSION['user'])){

				$user_id = $_SESSION['user']['id'];

				if(!empty($_POST)){

					if($isMember){

		                if(!empty($_POST['type'])){
		                    if($_POST['type'] == 0 || $_POST['type'] == 1){
		                        $type = $_POST['type'];
		                    }else{
		                        $type = 0;
		                    }
						}

						if($type == 0){
							if(!empty($_POST['item'])){
								$item = mb_convert_encoding($_POST['item'], "UTF-8");
							}
						}

						if(!empty($_POST['desc'])){

							$quest_description = mb_convert_encoding($_POST['desc'], "UTF-8");
						}

						$submition = $this->feedDAO->addQuest($item,$user_id,$quest_description,$type,$active);	

						if(!empty($submition)){

							$this->communityDAO->addCommuntyQuest($submition['quest_id'],$_GET['id']);

							if($type == 1){
								if(!empty($_POST['collection_item'])){
									$this->offerDAO->addOffer($submition['quest_id'],$_POST['collection_item']);
								}
							}

							if(isset($_FILES['quest_upload_image']) && $_FILES['quest_upload_image']['size'] != 0){

								$max_file_size = 1024*100000; // 200kb
								$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
								// thumbnail sizes
								$sizes = array(700 => 700);

								if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['quest_upload_image'])) {
								  if( $_FILES['quest_upload_image']['size'] < $max_file_size ){
								    // get file extension
								    $ext = strtolower(pathinfo($_FILES['quest_upload_image']['name'], PATHINFO_EXTENSION));
								    if (in_array($ext, $valid_exts)) {
								      /* resize image */
								      foreach ($sizes as $w => $h) {
								        $files[] = $this->resize($w, $h);
								      }

								      foreach ($files as $key => $value) {
								      	$this->imagesDAO->addImage($submition['quest_id'],$value);
								      }

								    } else {
								      $msg = 'Unsupported file';
								    }
								  } else{
								    $msg = 'Please upload image smaller than 200KB';
								  }
								}

							}

						}

					}
				}

					


			}
			$quests = $this->feedDAO->getQuestsByCommunity($_GET['id']);

		}else{

			$this->redirect("?page=404");
		}

        
		$this->set('community',$community);
		$this->set('isMember',$isMember);
		$this->set('users',$users);
		$this->set('quests',$quests);
        $this->set('collection',$collection);

	}

	public function communities(){

		$communities = array();

		if(isset($_SESSION['user'])){
			$communities = $this->communityDAO->getAllCommunities();
		}

		if(!empty($_POST)){
			$this->createCommunity();
		}
		$this->set('communities',$communities);
	}

	function createCommunity(){

		$community_name = "";
		$community_description = "";
		$privacy = 1;

		if(!empty($_SESSION['user'])){

			$user_id = $_SESSION['user']['id'];

			if(!empty($_POST)){

				if(!empty($_POST['commmunity_privacy'])){
	                    if($_POST['commmunity_privacy'] == 0 || $_POST['commmunity_privacy'] == 1){
	                        $privacy = $_POST['commmunity_privacy'];
	                    }else{
	                        $privacy = 1;
	                    }
					}

					if(!empty($_POST['community_name'])){
						$community_name = mb_convert_encoding($_POST['community_name'], "UTF-8");
					}

					if(!empty($_POST['community_description'])){

						$community_description = mb_convert_encoding($_POST['community_description'], "UTF-8");
					}

					if(isset($_FILES['community_image']) && $_FILES['community_image']['size'] != 0){

						$max_file_size = 1024*100000; // 200kb
						$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
						// thumbnail sizes
						$sizes = array(200 => 200);

						if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['community_image'])) {
						  if( $_FILES['community_image']['size'] < $max_file_size ){
						    // get file extension
						    $ext = strtolower(pathinfo($_FILES['community_image']['name'], PATHINFO_EXTENSION));
						    if (in_array($ext, $valid_exts)) {
						      /* resize image */
						      foreach ($sizes as $w => $h) {
						        $files[] = $this->resize($w, $h);
						      }

						    } else {
						      $msg = 'Unsupported file';
						    }
						  } else{
						    $msg = 'Please upload image smaller than 200KB';
						  }
						}

					}

					$addedCommunity = $this->communityDAO->addCommunity($community_name,$files[0],$_SESSION['user']['id'],$community_description,$privacy);	

					if(!empty($addedCommunity)){
						$this->communityDAO->addCommuntyUser($_SESSION['user']['id'],$addedCommunity['id']);
						$this->redirect("index.php?page=community&id=".$addedCommunity['id']);
					}
					
			}
		}
	}
    
    function resize($width, $height){
		/* Get original image x y*/
		list($w, $h) = getimagesize($_FILES['community_image']['tmp_name']);
		/* calculate new image size with ratio */
		$old_x          =   $w;
	    $old_y          =   $h;
	    $new_height = $width;
	    $new_width = $height;

	    if($old_x > $old_y) 
	    {
	        $thumb_w    =   $new_width;
	        $thumb_h    =   $old_y*($new_height/$old_x);
	    }

	    if($old_x < $old_y) 
	    {
	        $thumb_w    =   $old_x*($new_width/$old_y);
	        $thumb_h    =   $new_height;
	    }

	    if($old_x == $old_y) 
	    {
	        $thumb_w    =   $new_width;
	        $thumb_h    =   $new_height;
	    }
		/* new file name */
		$randomname = $this->generateRandomString();
		$banner = $randomname.".jpg";

		$path = WWW_ROOT . 'images' . DS .'communities'.DS.$banner;
		/* read binary data from image file */
		$imgString = file_get_contents($_FILES['community_image']['tmp_name']);

		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($thumb_w,$thumb_h);
		imagecopyresampled($tmp,$image,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		/* Save image */
		switch ($_FILES['community_image']['type']) {
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

	private function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	


}


