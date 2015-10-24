<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class VerificationController extends AppController{


	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'VerificationDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'UserDAO.php';
		require_once WWW_ROOT . 'PHPMailer-master' .DS. 'PHPMailerAutoload.php';

		$this->verificationDAO = new VerificationDAO();
		$this->userDAO = new UserDAO();
		$this->mail = new PHPMailer();

	}

	public function verification(){

		$verified = false;
		$verificationSent = false;
		$message = "";


		if(!empty($_POST)){

			$errors = array();
			$code = "";


			if(isset($_POST['digit_1']) && isset($_POST['digit_2']) && isset($_POST['digit_3'])  && isset($_POST['digit_4'])){
				$code = (string)$_POST['digit_1']."".(string)$_POST['digit_2']."".(string)$_POST['digit_3']."".(string)$_POST['digit_4'];
			}else{
				array_push($errors, "Fill in all digits");
				$message = "Fill in all digits";
			}

			if(empty($errors)){

				if(isset($_SESSION['user'])){
					$checkVerif = $this->verificationDAO->getVerificationByUserId($_SESSION['user']['id']);
					if(!empty($checkVerif)){
						if($checkVerif['verified'] == 0){

							if($checkVerif['code'] == $code){

								$verify = $this->verificationDAO->verifyUser($checkVerif['id']);

								if($verify){
									$user = $this->userDAO->verifyUser($_SESSION['user']['id']);
									if($user){
										$_SESSION['user']['verification'] = 1;
										$verified = true;
									}

								}

							}else{
								$message = "Your code is wrong";
							}
						}
					}

				}else{
					$this->redirect("?page=login");
				}

			}

		}

		if(!empty($_GET['action']) && $_GET['action'] == "resend" ){

			if(isset($_SESSION['user'])){
				$newCode = $this->verificationDAO->getVerificationByUserId($_SESSION['user']['id']);
				if(!empty($newCode)){
					$verificationSent = $this->sendValidationCode($newCode['code'],$_SESSION['user']['email']);
				}
			}

		}

		
	$this->set('verified',$verified);
	$this->set('verificationSent',$verificationSent);
	$this->set('message',$message);

	}




	public function sendValidationCode($code,$email){

		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'smtpout.europe.secureserver.net';  // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'info@droopl.com';                 // SMTP username
		$this->mail->Password = 'Droopl543';                           // SMTP password
		$this->mail->SMTPSecure = 'ssl';                      // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 465;     

		$this->mail->setFrom('info@droopl.com', 'Droopl');
		$this->mail->addAddress($email);     // Add a recipient 
		$this->mail->addReplyTo('info@droopl.com', 'Droopl');

		$this->mail->isHTML(true);                                  // Set email format to HTML

		$this->mail->Subject = 'Heey this is a subject';
		$this->mail->Body    = '<header style="width:100%;float:left;text-align:center;"><img src="http://droopl.com/images/droopl_mail.png" style="display:inline-block;height:100px;"><br/><h1 style="width:100%;box-sizing:border-box;padding:5%;font-size:2em;color:#5F6970;text-align:center">You have been succesfully registered <br/> Your validationcode is:</h1><h2 style="width:100%;box-sizing:border-box;padding:5%;font-size:4em;letter-spacing:2px;color:#3E454C;text-align:center">'.$code.'</h2></header>';

		return $this->mail->send();

	}

}


