<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class VerificationController extends AppController{


	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'VerificationDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'UserDAO.php';

		$this->verificationDAO = new VerificationDAO();
		$this->userDAO = new UserDAO();

	}

	public function verification(){

		if(!empty($_GET['code']) && !empty($_GET['id'])){
			if(isset($_SESSION['user'])){

				$checkVerif = $this->verificationDAO->getVerificationById($_GET['id']);
				if(!empty($checkVerif)){
					if($checkVerif['user_id'] == $_SESSION['user']['id']){

						if($checkVerif['verified'] == 0){

							if($checkVerif['code'] == $_GET['code']){

								$verify = $this->verificationDAO->verifyUser($_GET['id']);

								if($verify){

									$user = $this->userDAO->verifyUser($_SESSION['user']['id']);
									if($user){

									$this->redirect("?page=feed");
									}

								}

							}else{
								echo "code was wrong";
							}
						}else{
							$this->redirect("?page=feed");
						}
					}
				}

			}else{
				$this->redirect("?page=login");
			}
		}else{
			$this->redirect("?page=feed");
		}

	}

}


