<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class UserController extends AppController{


	public $feedDAO;
	public $userDAO;

	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'FeedDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'NotificationsDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'FollowDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'UserDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'PropoDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'VerificationDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';

		$this->feedDAO = new FeedDAO();
		$this->followDAO = new FollowDAO();
		$this->notificationsDAO = new NotificationsDAO();
		$this->verifDAO = new VerificationDAO();
		$this->collectionDAO = new CollectionDAO();
		$this->propoDAO = new PropoDAO();
		$this->userDAO = new UserDAO();

	}

	public function user(){

		$id = "";
		$quests = [];
		$collection = [];
		$followers = [];
		$proposals = [];
		$user = [];

		
		$type = "quests";
		$isFollowed = false;

		if(isset($_SESSION['user'])){
			$checkFollow = $this->followDAO->checkFollow($_SESSION['user']['id'],$_GET['id']);
			if(!empty($checkFollow)){
				$isFollowed = true;	
			}
		}
		

		if(!empty($_GET["id"])){

			$id = $_GET['id'];
			$user = $this->userDAO->getUserById($id);
			if(!empty($user)){

				if(!empty($_GET["filter"])){
					switch ($_GET["filter"]) {
						case 'collection':
							$type = "collection";

							$collection = $this->collectionDAO->getCollectionByUserId($id);
							break;

							case 'followers':
							$type = "followers";

							$followers = $this->followDAO->getFollowersByUserId($id);
							break;
						
						default:
							$type = "quests";

							$quests = $this->feedDAO->getQuestByUserId($id);

							break;
					}
				}else{


					$quests = $this->feedDAO->getQuestByUserId($id);

				}

			}else{
				header("location:index.php");
			}

		}else{

			header("location:index.php");
		}

		if(isset($_GET['action']) && $_GET['action'] == 'follow'){

			
			if(!$isFollowed){
				$followed = $this->followDAO->addFollow($_SESSION['user']['id'],$_GET['id']);

				if($followed){
					$isFollowed = true;
					if(!empty($_GET['id']) && isset($_SESSION['user'])){

						$checkIfFollow = $this->followDAO->checkFollow($_GET['id'],$_SESSION['user']['id']);
							print_r($checkIfFollow);
						if(!empty($checkIfFollow)){
							$this->notificationsDAO->addNotification($_GET['id'],"",3,$_SESSION['user']['id']);
						}else{
							$this->notificationsDAO->addNotification($_GET['id'],"",2,$_SESSION['user']['id']);
						}

					}

				}

			}else{
				echo "allready followed";
			}

			
		}

		if(isset($_GET['action']) && $_GET['action'] == 'unfollow'){

			
			if($isFollowed){
				$followed = $this->followDAO->removeFollow($_SESSION['user']['id'],$_GET['id']);

				if($followed){
					$isFollowed = false;
				}

			}

			
		}

		$this->set('isFollowed',$isFollowed);
		$this->set('user',$user);
		$this->set('quests',$quests);
		$this->set('collection',$collection);
		$this->set('followers',$followers);

	}

	public function register(){

		$first = "";
		$last = "";
		$mail = "";
		$pass = "";
		$birth = "";
		$selected_lang = "";
		$gender = "";

		$code = $this->generateValidationCode();
		$this->verifDAO->addVerification("1",$code);

		if(!empty($_POST)){
			
			if(!empty($_GET['step']) && $_GET['step'] == "1"){

				$step1 = array();

				if(!isset($_SESSION['register_step1'])){
					if(!empty($_POST['first'])){
						$step1["first"] = $_POST['first'];
					}
					if(!empty($_POST['last'])){
						$step1["last"] = $_POST['last'];
					}
					if(!empty($_POST['mail'])){
						$step1["mail"] = $_POST['mail'];
					}

					if(!empty($_POST['pass']) && $_POST['pass'] == $_POST['repeat_pass']){
						$step1["pass"] = $_POST['pass'];
					}

					if(!empty($_POST['birth_date'])){
						$step1["birth"] = $_POST['birth_date'];

						//$date = DateTime::createFromFormat('Y-M-j', $_POST['birth_date']);

					}
					if(!empty($_POST['selected-lang'])){
						$step1["lang"] = $_POST['selected-lang'];
					}
					if(!empty($_POST['gender'])){
						$step1["gender"] = $_POST['gender'];
					}

					if(isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] != 0){
						$step1["profile_image"] = $_FILES['profile_image'];
					}

					if(!empty($step1)){
						$_SESSION['register_step1'] = $step1;
						print_r($_SESSION['register_step1']);
					}
				}
				
			}

			if(!empty($_GET['step']) && $_GET['step'] == "2"){
				echo "step 2";
				print_r($_POST);
			}
		}
	}
	

	public function login(){
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
		$email = "";
		$password = "";
        $isloggedin = "false";
		$user = [];

		if(!isset($_SESSION['user'])){

			if(!empty($_POST)){

				$_SESSION['errors'] = [];

				if(!empty($_POST['email']) && preg_match($pattern, $_POST['email']) === 1){
					$email = $_POST['email'];
				}else{
					array_push($_SESSION['errors'], "Email is wrong");
				}
				if(!empty($_POST['pass'])){
					$password = $_POST['pass'];
				}else{
					array_push($_SESSION['errors'], "password is wrong");
				}


				if(empty($_SESSION['errors'])){

					$user = $this->userDAO->loginUser($email,$password);

					if(!empty($user)){

						$_SESSION['user'] = $user;
                        $isloggedin = "true";

						//header("location:?page=feed");
					}

				}

			}
		}else{
			header("location:?page=feed");
		}

		$this->set('email',$email);
		$this->set('password',$password);
        $this->set('isloggedin',$isloggedin);

	}


	private function generateValidationCode($length = 4) {
	    $characters = '0123456789';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


}


