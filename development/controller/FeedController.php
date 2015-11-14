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
		require_once WWW_ROOT . 'dao' .DS. 'CommunityDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';

		$this->feedDAO = new FeedDAO();
		$this->offerDAO = new OfferDAO();
		$this->propoDAO = new PropoDAO();
		$this->imagesDAO = new ImagesDAO();
		$this->notificationsDAO = new NotificationsDAO();
		$this->userDAO = new UserDAO();
		$this->communityDAO = new CommunityDAO();
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
        $communities = [];
		$publicQuests;
		$page = 10;

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

		if(!empty($_GET['part'])){
			$page *= intval($_GET['part']);
		}else{
			$page *=0;
		}

		$publicquests = $this->feedDAO->getPublicQuests();

		if(isset($_SESSION['user'])){
			$quests = $this->getQuests($type,$page);
			$communities =  $this->communityDAO->getCommunitiesByUserId($_SESSION['user']['id']);
            $collection = $this->collectionDAO->getCollectionByUserId($_SESSION['user']['id']);
		}else{
			$quests = $publicquests;
		}
		

		if(!empty($_SESSION['user'])){

			$user_id = $_SESSION['user']['id'];

			if(!empty($_POST)){

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

					if(!empty($_POST['destination']) && strtolower($_POST['destination']) == "public"){
						$this->feedDAO->addPublicQuest($submition['quest_id'],$user_id);
					}else{
						$checkMember = $this->communityDAO->isMemberOfCommunity($user_id,$_POST['destination']);
						if(!empty($checkMember)){
							$this->communityDAO->addCommuntyQuest($submition['quest_id'],$_POST['destination']);
						}
					}

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
		$this->set('communities',$communities);
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
        $acceptedProposal = array();
        $publicQuests = array();
        $accepted = false;
        $completed = false;

        $questcount =  $this->feedDAO->getQuestCount();
		$propocount =  $this->propoDAO->getPropoCount();
		$usercount = $this->userDAO->getUserCount();

    	if(isset($_GET) && !empty($_GET['questid'])){

    		$quest = $this->feedDAO->getQuestById($_GET['questid']);
    		$publicquests = $this->feedDAO->getPublicQuests();
    		$communities =  $this->communityDAO->getCommunitiesByUserId($_SESSION['user']['id']);
    		$collection = $this->collectionDAO->getCollectionByUserId($_SESSION['user']['id']);

    		if(empty($quest)){
    			$this->redirect("?page=feed");
    		}else if($quest['active'] == 0){
    			$this->redirect("?page=feed");
    		}

    		$acceptedProposal = $this->propoDAO->getAcceptedProposalByQuestId($quest['quest_id']);

    		if(!empty($acceptedProposal)){
    			$accepted = true;
    		}

    		$completedQuest = $this->feedDAO->checkCompletedByQuestId($_GET['questid']);

    		if(!empty($completedQuest)){
    			$completed = true;
    		}

    		if(isset($_SESSION['user'])){
    			if(!empty($_GET['action']) && $_GET['action'] == "remove"){
	    			if($quest['id'] == $_SESSION['user']['id']){
	    				$removed = $this->feedDAO->removeQuest($quest['quest_id']);
	    				if($removed){
	    					$this->redirect("?page=user&id=".$_SESSION['user']['id']);
	    				}
	    			}
	    		}

    		}

    		if(!$completed){
    			if(isset($_SESSION['user'])){
	    			if(!empty($_GET['action']) && $_GET['action'] == "complete"){
		    			if($quest['id'] == $_SESSION['user']['id']){
		    				$completeQuest = $this->feedDAO->completeQuest($quest['quest_id']);
		    				if($completeQuest){
		    					$this->redirect("?page=detail&questid=".$quest['quest_id']);
		    				}
		    			}
		    		}

	    		}
    		}
    		if(!$accepted){
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
	                if($quest['id'] == $_SESSION['user']['id']){
	                	if(!empty($_GET['id'])){
	                		$acceptPropo = $this->propoDAO->acceptProposal($_GET['id'],$quest['quest_id']);
	                		if(!empty($acceptPropo)){
	                			$this->notificationsDAO->addNotification($acceptPropo['id'],$_GET['questid'],6,$_SESSION['user']['id']);
	                			$this->redirect("?page=detail&questid=".$quest['quest_id']);
	                		}
	                	}
		    		}

		    		

		    		if(!empty($_GET['action']) && $_GET['action'] == "delete" && !empty($_GET['id'])){
		    			$currentPropo = $this->propoDAO->getProposalById($_GET['id']);
		    			if($currentPropo['user_id'] == $_SESSION['user']['id']){
		    				$this->propoDAO->removePropo($currentPropo['propo_id']);
		    				$this->redirect("?page=detail&questid=".$quest['quest_id']);
		    			}
		    		}
	            }
            

	    		if(!empty($quest)){
	    			$proposals = $this->propoDAO->getProposalsByQuestId($quest['quest_id']);
	    			$updateviews = $this->feedDAO->updateViewById($_GET['questid']);
	    		}

    		}

    		
    	}else{
    		$this->redirect("?page=feed");
    	}


    	$this->set("quest",$quest);
    	$this->set("publicquests",$publicquests);
    	$this->set("communities",$communities);
    	$this->set("completed",$completed);
    	$this->set("accepted",$accepted);
    	$this->set("acceptedProposal",$acceptedProposal);
    	$this->set("proposals",$proposals);
        $this->set("collection",$collection);
        $this->set('questcount',$questcount);
		$this->set('propocount',$propocount);
		$this->set('usercount',$usercount);
        
    }

    public function search()
    {	
    	$searchQuery = "";
    	$quests = array();
    	$users = array();
    	$items = array();

    	if(!empty($_GET['search_full'])){
    		$searchQuery = $_GET['search_full'];

    		$users = $this->userDAO->getSearchUsers($searchQuery);
    		$items = $this->collectionDAO->getSearchCollection($searchQuery);
    		$quests = $this->feedDAO->getSearchQuests($searchQuery);
    	}
    	$this->set("users",$users);
    	$this->set("items",$items);
    	$this->set("quests",$quests);
    	
    }

	private function getQuests($type,$page){

		$quests = array();

		switch ($type) {
			case 'popular':
				$quests = $this->feedDAO->getQuestsByViews($_SESSION['user']['id'],$page);
				break;

			case 'nearby':
			$quests = $this->feedDAO->getQuestFromDistance($_SESSION['user']['id'],$_SESSION['user']['latitude'],$_SESSION['user']['longitude'],$page);
			break;
			
			default:
				$quests = $this->feedDAO->getQuests($_SESSION['user']['id'],$page);
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


