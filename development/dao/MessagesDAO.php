<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class MessagesDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function getMessagesByConversationId($conversation_id){

		$sql = 'SELECT m.message_id,m.message,u.id, u.firstname ,u.lastname,u.picture
		FROM messages AS m
		LEFT OUTER JOIN users AS u
        on m.user_id = u.id
        WHERE m.conversation_id = :conversation_id
        GROUP BY m.message_id
        ORDER BY m.message_creation_date DESC LIMIT 10 OFFSET 0';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':conversation_id',$conversation_id);

		if($stmt->execute()){

			$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($messages)){

				return $messages;
			}

		}
		return array();
	}

	
	public function addMessage($conversation_id,$user_id,$message){


		$sql = "INSERT INTO messages (conversation_id, user_id, message) VALUES (:conversation_id,:user_id, :message);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":conversation_id",$conversation_id);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":message",$message);

        if($stmt->execute()){

            return true;
        }
        return false;
	}
}