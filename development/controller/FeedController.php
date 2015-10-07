<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class FeedController extends AppController{


	public $feedDAO;
	public $userDAO;

	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'FeedDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'OfferDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'NotificationsDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'PropoDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'ImagesDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'UserDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';

		$this->feedDAO = new FeedDAO();
		$this->offerDAO = new OfferDAO();
		$this->propoDAO = new PropoDAO();
		$this->imagesDAO = new ImagesDAO();
		$this->notificationsDAO = new NotificationsDAO();
		$this->userDAO = new UserDAO();
		$this->collectionDAO = new CollectionDAO();

	}

	public function feed(){

		$item = "";
		$user_id = "";
		$quest_description = "";
		$type = 0;
		$active = true;
		$quests = [];
		$image = "";

		$proposals = [];
        $collection = [];
		$publicQuests;

		$type = "recent";

		$questcount =  $this->feedDAO->getQuestCount();
		$propocount =  $this->propoDAO->getPropoCount();
		$usercount = $this->userDAO->getUserCount();

		if(!empty($_GET["filter"])){
			switch ($_GET["filter"]) {
				case 'popular':
					$type = "popular";
					break;

				case 'nearby':
				$type = "nearby";
				break;
				
				default:
					$type = "recent";
					break;
			}
		}

		$publicquests = $this->feedDAO->getPublicQuests();

		if(isset($_SESSION['user'])){
			$quests = $this->getQuests($type);
            $collection = $this->collectionDAO->getCollectionByUserId($_SESSION['user']['id']);
		}else{
			$quests = $publicquests;
		}
		

		if(!empty($_SESSION['user'])){

			$user_id = $_SESSION['user']['id'];

			if(!empty($_POST['desc'])){

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


					$quests = $this->getQuests($type);
				}
			}

				


		}

		$this->set('quests',$quests);
		$this->set('publicquests',$publicquests);
		$this->set('proposals',$proposals);
        $this->set('collection',$collection);
		$this->set('questcount',$questcount);
		$this->set('propocount',$propocount);
		$this->set('usercount',$usercount);

	}
    
    public function detail(){

    	$quest = array();
    	$proposals = array();
        $collection = array();


    	if(isset($_GET) && !empty($_GET['questid'])){

    		$quest = $this->feedDAO->getQuestById($_GET['questid']);

    		if(!empty($_POST)){
	    		if(!empty($_POST['collection_item'])){
	    			if(!empty($_GET['questid'])){
	    				$propo = $this->propoDAO->addProposal($_GET['questid'],$_SESSION['user']['id'],$_POST['collection_item']);

	    				if($propo){
	    					$this->notificationsDAO->addNotification($quest['id'],$_GET['questid'],0,$_SESSION['user']['id']);
	    				}
	    			}
	    		}
	    	}
            
            if(isset($_SESSION['user'])){
                $collection = $this->collectionDAO->getCollectionByUserId($_SESSION['user']['id']);
            }

    		if(!empty($quest)){
    			$proposals = $this->propoDAO->getProposalsByQuestId($quest['quest_id']);
    			$updateviews = $this->feedDAO->updateViewById($_GET['questid']);
    		}else{
    			$this->redirect("?page=feed");
    		}
    	}


    	$this->set("quest",$quest);
    	$this->set("proposals",$proposals);
        $this->set("collection",$collection);
        
    }

    public function search()
    {	
    	$searchQuery = "";
    	$quests = array();

    	if(!empty($_POST['search_full'])){
			$searchQuery = $_POST['search_full'];
			$quests = $this->feedDAO->getSearchQuests($searchQuery);
    	}

    	$this->set("quests",$quests);
    	
    }

	private function getQuests($type){

		$quests = array();

		switch ($type) {
			case 'popular':
				$quests = $this->feedDAO->getQuestsByViews($_SESSION['user']['id']);
				break;

			case 'nearby':
			$quests = $this->feedDAO->getQuestFromDistance($_SESSION['user']['id'],$_SESSION['user']['latitude'],$_SESSION['user']['longitude']);
			break;
			
			default:
				$quests = $this->feedDAO->getQuests($_SESSION['user']['id']);
				break;
		}

		return $quests;

	}

	function resize($width, $height){
		/* Get original image x y*/
		list($w, $h) = getimagesize($_FILES['quest_upload_image']['tmp_name']);
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

		$path = WWW_ROOT . 'questimages' . DS .'images'.DS.$banner;
		/* read binary data from image file */
		$imgString = file_get_contents($_FILES['quest_upload_image']['tmp_name']);

		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($thumb_w,$thumb_h);
		imagecopyresampled($tmp,$image,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		/* Save image */
		switch ($_FILES['quest_upload_image']['type']) {
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

