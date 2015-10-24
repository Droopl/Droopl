<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class FeedbackController extends AppController{


	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'FeedbackDAO.php';

		$this->feedbackDAO = new FeedbackDAO();

	}

	public function feedback(){

		$feedback = "";
		$type = 0;
		$feedbackSent = false;

		if(isset($_SESSION['user'])){

			if(!empty($_POST)){

				if(!empty($_POST['type'])){
					$type = $_POST['type'];
				}
				if(!empty($_POST['feedback'])){
					$feedback = $_POST['feedback'];

					$feedbackSent = $this->feedbackDAO->addFeedback($_SESSION['user']['id'],$feedback,$type);

				}
			}


		}else{
			$this->redirect("?page=login");
		}
		
		echo $feedbackSent;
		
		exit();
	}

}


