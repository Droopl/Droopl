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
		require_once WWW_ROOT . 'dao' .DS. 'ImagesDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'PropoDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'VerificationDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'CollectionDAO.php';
		require_once WWW_ROOT . 'PHPMailer-master' .DS. 'PHPMailerAutoload.php';


		$this->feedDAO = new FeedDAO();
		$this->followDAO = new FollowDAO();
		$this->notificationsDAO = new NotificationsDAO();
		$this->verifDAO = new VerificationDAO();
		$this->collectionDAO = new CollectionDAO();
		$this->propoDAO = new PropoDAO();
		$this->userDAO = new UserDAO();
		$this->imagesDAO = new ImagesDAO();
		$this->mail = new PHPMailer();

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

			$firstname = "";
			$lastname = "";
			$password = "";
			$occupation = "";
			$date = "08/01/2016";
			$gender = "";
			$lang = "";
			$image = "";

			if(!empty($_GET["action"]) && $_GET["action"] == "update"){

				if(!empty($_POST)){
					$errors =  false;

					if(!empty($_POST["first"])){
						$firstname = $_POST["first"];
					}else{
						$errors = true;
					}

					if(!empty($_POST["last"])){
						$lastname = $_POST["last"];
					}else{
						$errors = true;
					}

					if(!empty($_POST["new_pass"]) && !empty($_POST["repeat_new_pass"]) && $_POST["new_pass"] == $_POST["repeat_new_pass"]){
						$password = $_POST["new_pass"];
					}


					if(!empty($_POST["birth_date"])){
						$date = $_POST["birth_date"];
					}


					if(!empty($_POST["selected-lang"])){
						$lang = $_POST["selected-lang"];
					}else{
						$errors = true;
					}

					if(!empty($_POST["occupation"])){
						$occupation = $_POST["occupation"];
					}else{
						$occupation = true;
					}

					if(!empty($_POST["gender"])){
						$gender = $_POST["gender"];
					}else{
						$errors = true;
					}

					if(isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] != 0){

						$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
						// thumbnail sizes
						$sizes = array(700 => 700);

						if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['profile_image'])) {

							$ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
							if(in_array($ext, $valid_exts)) {
								/* resize image */
								foreach ($sizes as $w => $h) {
									$files[] = $this->resizeCropped($w, $h);
								}
								$image = $files[0];

							} else {
								$msg = 'Unsupported file';
							}

							}else{
								$msg = 'Please upload image smaller than 200KB';
							}
					}

					if(!$errors){

						$noimage = false;
						$nopassword = false;
						if($password == ""){
							$nopassword = true;
						}
						if($image == ""){
							$noimage = true;
						}

						$user = array();

						if($noimage && $nopassword){

							$user = $this->userDAO->updateUserWithoutImageAndPassword($firstname,$lastname,$occupation,$date,$gender,$lang,$_SESSION["user"]["id"]);

						}else if($noimage){
							$user = $this->userDAO->updateUserWithoutImage($firstname,$lastname,$password,$occupation,$date,$gender,$lang,$_SESSION["user"]["id"]);

						}else if($nopassword){
							$user = $this->userDAO->updateUserWithoutPassword($firstname,$lastname,$occupation,$date,$gender,$lang,$image,$_SESSION["user"]["id"]);
						}else{
							$user = $this->userDAO->updateUser($firstname,$lastname,$password,$occupation,$date,$gender,$lang,$image,$_SESSION["user"]["id"]);
						}

						if(!empty($user) && $_SESSION["user"] != $user){
							$_SESSION["user"] = $user;
						}

						$this->redirect("?page=user&id=".$_SESSION["user"]["id"]);

					}else{
						$this->redirect("?page=user&id=".$_SESSION["user"]["id"]);
					}

				}
			}


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
		$picture = "";
		$street = "";
		$number = "";
		$zipcode = "";
		$occupation = "";
		$city = "";
		$country = "";
		$latitude = "";
		$longitude = "";

		$message = 0;


		if(!empty($_POST['register_submit']) && $_POST['register_submit'] == "post"){


			if(!empty($_POST["item"])){
				$_SESSION['quest'] = $_POST;

				if(isset($_FILES['quest_upload_image']) && $_FILES['quest_upload_image']['size'] != 0){
					$_SESSION['quest']["file"] = $_FILES['quest_upload_image'];
				}

				if(!empty($_FILES['quest_upload_image'])){
					$max_file_size = 1024*100000; // 200kb
					$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
					// thumbnail sizes
					$sizes = array(700 => 700);

					if (isset($_FILES['quest_upload_image'])) {
						if( $_FILES['quest_upload_image']['size'] < $max_file_size ){
							// get file extension
							$ext = strtolower(pathinfo($_FILES['quest_upload_image']['name'], PATHINFO_EXTENSION));
							if (in_array($ext, $valid_exts)) {
								/* resize image */
								foreach ($sizes as $w => $h) {
									$files[] = $this->resizeQuest($w, $h);
								}

								foreach ($files as $key => $value) {

									//$this->imagesDAO->addImage($submition['quest_id'],$value);
									$_SESSION['quest']["file"] = $value;
								}

							}
						}
					}
				}


			}else{
				$this->redirect("index.php?page=login");
			}



		}

		if(!empty($_POST) && empty($_POST['register_submit'])){

			if(!empty($_GET['step']) && $_GET['step'] == "1"){

				$step1 = array();

				if(!empty($_POST['first'])){
						$step1["first"] = $_POST['first'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['last'])){
						$step1["last"] = $_POST['last'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['mail'])){
						$step1["mail"] = $_POST['mail'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['pass']) && $_POST['pass'] == $_POST['repeat_pass']){
						$step1["pass"] = $_POST['pass'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['birth_date'])){
						$step1["birth"] = $_POST['birth_date'];
						$message = 1;
						//$date = DateTime::createFromFormat('Y-M-j', $_POST['birth_date']);

					}else{
						$message = 0;
					}
					if(!empty($_POST['selected-lang'])){
						$step1["lang"] = $_POST['selected-lang'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['agreed']) && $_POST['agreed'] == "1"){
						$step1["agreed"] = $_POST['agreed'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['gender'])){
						$step1["gender"] = $_POST['gender'];
						$message = 1;
					}else{
						$message = 0;
					}
					$step1["profile_image"] = "";
					if(isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] != 0){

						$max_file_size = 1024*100000; // 200kb
						$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
						// thumbnail sizes
						$sizes = array(700 => 700);

						if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['profile_image'])) {
							$ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
							if(in_array($ext, $valid_exts)) {
								/* resize image */
								foreach ($sizes as $w => $h) {
									$files[] = $this->resizeCropped($w, $h);
								}
								$step1["profile_image"] = $files[0];

							} else {
								$msg = 'Unsupported file';
							}

							}else{
								$msg = 'Please upload image smaller than 200KB';
							}
					}

					if(!empty($step1)){
						$_SESSION['register_step1'] = $step1;
					}else{
						$message = 0;
					}
			}else{
				$step2 = array();

				if(!empty($_POST['street'])){
						$step2["street"] = $_POST['street'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['number'])){
						$step2["number"] = $_POST['number'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['zipcode'])){
						$step2["zipcode"] = $_POST['zipcode'];
						$message = 1;
					}else{
						$message = 0;
					}

					if(!empty($_POST['city']) ){
						$step2["city"] = $_POST['city'];
						$message = 1;
					}else{
						$message = 0;
					}

					if(!empty($_POST['country'])){
						$step2["country"] = $_POST['country'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['latitude'])){
						$step2["latitude"] = $_POST['latitude'];
						$message = 1;
					}else{
						$message = 0;
					}
					if(!empty($_POST['longitude'])){
						$step2["longitude"] = $_POST['longitude'];
						$message = 1;
					}else{
						$message = 0;
					}

					if(!empty($step2)){

						$_SESSION['register_step2'] = $step2;
						$message = 1;
					}else{
						$message = 0;
					}

					if(isset($_SESSION['register_step1']) && isset($_SESSION['register_step2'])){

						$first = $_SESSION['register_step1']['first'];
						$last = $_SESSION['register_step1']['last'];
						$mail = $_SESSION['register_step1']['mail'];
						$pass = $_SESSION['register_step1']['pass'];
						$birth = $_SESSION['register_step1']['birth'];
						$selected_lang = $_SESSION['register_step1']['lang'];
						$gender = $_SESSION['register_step1']['gender'];
						$picture = $_SESSION['register_step1']['profile_image'];
						$street = $_SESSION['register_step2']['street'];
						$number = $_SESSION['register_step2']['number'];
						$zipcode = $_SESSION['register_step2']['zipcode'];
						$city = $_SESSION['register_step2']['city'];
						$country = $_SESSION['register_step2']['country'];
						$latitude = $_SESSION['register_step2']['latitude'];
						$longitude = $_SESSION['register_step2']['longitude'];

						$register = $this->userDAO->register($first,$last,$mail,$pass,$birth,$selected_lang,$gender,$picture,$occupation,$street,$number,$zipcode,$city,$country,$latitude,$longitude);

						if(!empty($register)){
							$code = $this->verifDAO->addVerification($register['id'],$this->generateValidationCode());

							$followed = $this->followDAO->addFollow($register['id'],$register['id']);
							$loginUser = $this->userDAO->loginUser($register['email'],$pass);
							if(!empty($loginUser)){
								$_SESSION['user'] = $loginUser;
							}

							if(!empty($_SESSION["quest"])){


								$submition = $this->feedDAO->addQuest($_SESSION["quest"]["item"],$register["id"],$_SESSION["quest"]["desc"],0,true);
								if($submition){
									$this->feedDAO->addPublicQuest($submition['quest_id'],$register["id"]);
									$this->imagesDAO->addImage($submition['quest_id'],$_SESSION["quest"]["file"]);
								}



								unset($_SESSION['quest']);
							}

							$this->sendValidationCode($code["code"],$register['email']);

							unset($_SESSION['register_step1']);
							unset($_SESSION['register_step2']);
						}
					}
			}
			echo $message;

			exit();
		}
	}

	public function sendValidationCode($code,$email){

		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'droopl.info@gmail.com';                 // SMTP username
		$this->mail->Password = 'droopl111';                           // SMTP password
		$this->mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 587;

		$this->mail->setFrom('droopl.info@gmail.com', 'Droopl');
		$this->mail->addAddress($email);     // Add a recipient
		$this->mail->addReplyTo('droopl.info@gmail.com', 'Droopl');
		
		$this->mail->isHTML(true);                                  // Set email format to HTML

		$this->mail->Subject = 'Heey this is a subject';
		$this->mail->Body    = '<header style="width:100%;float:left;text-align:center;"><img src="http://droopl.com/images/droopl_mail.png" style="display:inline-block;height:100px;"><br/><h1 style="width:100%;box-sizing:border-box;padding:5%;font-size:2em;color:#5F6970;text-align:center">You have been succesfully registered <br/> Your validationcode is:</h1><h2 style="width:100%;box-sizing:border-box;padding:5%;font-size:4em;letter-spacing:2px;color:#3E454C;text-align:center">'.$code.'</h2></header>';

		$this->mail->send();

	}


	public function login(){
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
		$email = "";
		$password = "";
        $isloggedin = "false";
		$user = [];



		if(!empty($_SESSION['quest'])){
			if(!empty($_SESSION['quest']["file"])){
				unlink(WWW_ROOT . 'questimages' . DS .'images'.DS.$_SESSION['quest']["file"]);
			}
			unset($_SESSION['quest']);
		}

		if(!isset($_SESSION['user'])){

			if(!empty($_POST)){

				$_SESSION['errors'] = [];

				if(!empty($_POST['email']) && preg_match($pattern, $_POST['email']) === 1){
					$email = $_POST['email'];
				}else{
					array_push($_SESSION['errors'], "Fill in you email");
				}
				if(!empty($_POST['pass'])){
					$password = $_POST['pass'];
				}else{
					array_push($_SESSION['errors'], "Fill in your password");
				}


				if(empty($_SESSION['errors'])){

					$user = $this->userDAO->loginUser($email,$password);

					if(!empty($user)){

						$_SESSION['user'] = $user;
                        $isloggedin = "true";

						header("location:?page=feed");
						exit();
					}else{
						array_push($_SESSION['errors'], "Your email or password is wrong");
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

	function resizeCropped($width, $height){
	  /* Get original image x y*/
	  list($w, $h) = getimagesize($_FILES['profile_image']['tmp_name']);
	  /* calculate new image size with ratio */
	  $ratio = max($width/$w, $height/$h);
	  $h = ceil($height / $ratio);
	  $x = ($w - $width / $ratio) / 2;
	  $w = ceil($width / $ratio);
	  /* new file name */

	  $randomname = $this->generateRandomString();

		$banner = $randomname.".jpg";

		$path = WWW_ROOT . 'images' . DS .'profile_pictures'.DS.$banner;
	  /* read binary data from image file */
	  $imgString = file_get_contents($_FILES['profile_image']['tmp_name']);
	  /* create image from string */
	  $image = imagecreatefromstring($imgString);
	  $tmp = imagecreatetruecolor($width, $height);
	  imagecopyresampled($tmp, $image,
	    0, 0,
	    $x, 0,
	    $width, $height,
	    $w, $h);
	  /* Save image */
	  switch ($_FILES['profile_image']['type']) {
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


	function resize($width, $height){
		/* Get original image x y*/
		list($w, $h) = getimagesize($_FILES['profile_image']['tmp_name']);
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

		$path = WWW_ROOT . 'images' . DS .'profile_pictures'.DS.$banner;
		/* read binary data from image file */
		$imgString = file_get_contents($_FILES['profile_image']['tmp_name']);

		/* create image from string */
		$image = imagecreatefromstring($imgString);
		$tmp = imagecreatetruecolor($thumb_w,$thumb_h);
		imagecopyresampled($tmp,$image,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		/* Save image */
		switch ($_FILES['profile_image']['type']) {
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

	public function settings(){

		$user = array();

		if(isset($_SESSION['user'])){
			$user = $_SESSION['user'];
		}else{
			$this->redirect("?page=login");
		}

		$this->set('user',$user);

	}
	function resizeQuest($width, $height){
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
