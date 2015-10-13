<?php

require_once WWW_ROOT . 'controller'. DS .'AppController.php';

class MessagesController extends AppController{


	public function __construct(){

		require_once WWW_ROOT . 'dao' .DS. 'ConversationsDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'ConvoUsersDAO.php';
		require_once WWW_ROOT . 'dao' .DS. 'MessagesDAO.php';

		$this->conversationDAO = new ConversationsDAO();
		$this->convoUsersDAO = new ConvoUsersDAO();
		$this->messagesDAO = new MessagesDAO();

	}

	public function messages(){

		$conversations = array();
		$conversation = array();
		$messages = array();
		$convo_users = array();

		if(isset($_GET) &&!empty($_GET['typing'])){
			if(isset($_SESSION['conversation'])){

				$typing = filter_var($_GET['typing'], FILTER_VALIDATE_BOOLEAN);

				echo $this->convoUsersDAO->typingConversation($_SESSION['conversation']['conversation_id'],$_SESSION['user']['id'],$typing);
				exit();
			}
		}

		if(isset($_SESSION['user'])){

			if(!empty($_SESSION['user']['id'])){

				if(!empty($_GET['userid']) && !empty($_GET['action']) && $_GET['action'] == 'new'){
					$found = false;
					$user1 = $this->convoUsersDAO->getConversationByUserId($_GET['userid']);
					$user2 = $this->convoUsersDAO->getConversationByUserId($_SESSION['user']['id']);
					$convoid = 0;

					foreach ($user1 as $key => $val) {
						foreach ($user2 as $key => $value) {
							if($value['conversation_id'] == $val['conversation_id']){
								$found = true;
								$convoid = $value['conversation_id'];
							}
						}
					}
					if(!$found){
						$convoId = $this->conversationDAO->addConversation();
						if($convoId > 0){
							$newUsers = [$_SESSION['user']['id'],$_GET['userid']];
							foreach ($newUsers as $key => $user) {
								$this->convoUsersDAO->addConversationUser($convoId,$user);
								echo $user;
							}

							$this->redirect("?page=messages&id=".$convoId);
						}
					}else{
						$this->redirect("?page=messages&id=".$convoid);
					}
				}

				if(!empty($_GET['check']) && $_GET['check'] == "update"){
					if(isset($_SESSION['conversation'])){
						echo $this->conversationDAO->checkConversation($_SESSION['conversation']['conversation_id']);
						exit();
					}
				}

				$conversations = $this->convoUsersDAO->getConversationByUserId($_SESSION['user']['id']);
				$id = 0;
				if(isset($_GET) && !empty($_GET['id'])){
					$id = $_GET['id'];
					if($_SESSION["conversation"]["conversation_id"] != $id){
						unset($_SESSION["conversation"]);
					}
				}else{

					if(!empty($conversations)){
						$id = $conversations[0]['conversation_id'];
					}
				}

				$conversation = $this->conversationDAO->getConversationById($id,$_SESSION['user']['id']);

				if(empty($conversation)){
					$id = $conversations[0]['conversation_id'];
					$conversation = $this->conversationDAO->getConversationById($id);
					
				}
				if(!isset($_SESSION['conversation'])){
					$_SESSION['conversation'] = $conversation;
				}
				

				if(isset($_POST)){

					$message = ""; 

					if(!empty($_POST['message'])){
						$message = $_POST['message'];
					}

					if(!empty($message)){
						$this->messagesDAO->addMessage($_SESSION['conversation']['conversation_id'],$_SESSION['user']['id'],$message);
					}

				}

				if(isset($_SESSION['conversation'])){

					$convo_users = $this->convoUsersDAO->getUserByConversationId($conversation['conversation_id']);
					$messages = $this->messagesDAO->getMessagesByConversationId($conversation['conversation_id']);
				}

			}

		}else{

			$this->redirect("?page=login");
		}



		$this->set('conversations',$conversations);
		$this->set('conversation',$conversation);
		$this->set('convo_users',$convo_users);
		$this->set('messages',$messages);

	}

}


