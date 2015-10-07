<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class RatingController extends AppController{


	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'UserRatingDAO.php';

		$this->userRatingDAO = new UserRatingDAO();

	}

	public function rateuser(){

		if(!empty($_POST)){
			if(!empty($_GET['id'])){
				if(!empty($_POST['rating'])){
					if(isset($_SESSION['user'])){
						$checkRated = $this->userRatingDAO->checkRated($_GET['id'],$_SESSION['user']["id"]);

						if(empty($checkRated)){
							$rate = $this->userRatingDAO->addRating($_GET['id'],$_SESSION['user']["id"],$_POST['rating']);
							if($rate){
								$this->redirect("index.php?page=user&id=".$_GET['id']."&action=rated");
							}
						}else{
							$this->redirect("index.php?page=user&id=".$_GET['id']."&action=allreadyrated");
						}
					}else{
						$this->redirect("index.php?page=feed");
					}
					
				}
			}else{
				$this->redirect("index.php?page=feed");
			}
		}else{

			$this->redirect("index.php?page=feed");
		}

		exit();

	}

}


