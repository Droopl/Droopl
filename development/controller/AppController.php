<?php

class AppController {

	public $route = array();
	public $viewVars = array();

	public function __construct() {

	}

	public function filter() {
		call_user_func(array($this, $this->route['action']));
		$this->logout();
		$this->language();
		$this->notifications();
		$this->converstations();
	}
	public function notifications(){
		require_once WWW_ROOT . 'dao' .DS. 'NotificationsDAO.php';

		$this->notificationsDAO = new NotificationsDAO();
		$notifications = array();

		if(!empty($_SESSION['user'])){
			$notifications = $this->notificationsDAO->getNotificationsByUserId($_SESSION['user']['id']);

			if(!empty($_POST['notification_id'])){

				$this->notificationsDAO->seenNotification($_POST['notification_id']);
			}
		}

		if(!isset($_SESSION['notifications'])){
			$_SESSION['notifications'] = $notifications;
		}else{

			if($_SESSION['notifications'] !=  $notifications){
				$_SESSION['notifications'] = $notifications;
			}
		}

		$this->set("notifications",$notifications);
	}

	public function converstations(){
		require_once WWW_ROOT . 'dao' .DS. 'ConvoUsersDAO.php';

		$this->convoUsersDAO = new ConvoUsersDAO();
		$converstations = array();

		if(!empty($_SESSION['user'])){
			$converstations = $this->convoUsersDAO->getConversationByUserId($_SESSION['user']['id']);
		}

		$this->set("dynamicConvos",$converstations);
	}

	public function render() {
		extract($this->viewVars, EXTR_OVERWRITE);
		require WWW_ROOT . 'parts/menu.php';
	    require WWW_ROOT . 'pages/' . strtolower($this->route['controller']) . DS . $this->route['action'] . '.php';
	    require WWW_ROOT . 'parts/footer.php';

		unset($_SESSION['errors']);
	}
	public function logout()
	{
		if(isset($_GET["action"]) && $_GET['action'] == 'logout'){

			unset($_SESSION['user']);
			header("location:?page=login");
		}
	}
	public function language()
	{	
		$language = "en";
		if(isset($_SESSION['user'])){
			$language = $_SESSION['user']['lang'];
		}

		switch ($language) {
			case 'en':
			$_SESSION['language'] = "en";
			break;

			case 'nl':
			$_SESSION['language'] = "nl";
			break;

			case 'fr':
			$_SESSION['language'] = "fr";
			break;
			
			default:
				$_SESSION['language'] = "en";
				break;
		}
	}

	public function set($variableName, $value) {
		$this->viewVars[$variableName] = $value;
	}

	public function addError($error){
		if(!isset($_SESSION["errors"])) {
			$_SESSION["errors"] = array();
		}
		$_SESSION["errors"][] = $error;
	}

	public function redirect($url) {
		header("Location: {$url}");
		exit();
	}

}