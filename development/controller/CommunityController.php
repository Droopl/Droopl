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

