<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class MessagesDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function getMessagesByConversationId($conversation_id){

		$sql = 'SELECT m.message_id,m.message,m.seen,u.id, u.firstname ,u.lastname,u.picture
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

	public function getMessageById($id){

		$sql = 'SELECT m.message_id,m.message,m.seen,u.id, u.firstname ,u.lastname,u.picture
		FROM messages AS m
		LEFT OUTER JOIN users AS u
        on m.user_id = u.id
        WHERE m.message_id = :id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			$message = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($message)){

				return $message;
			}

		}
		return array();
	}


	public function setMessageSeen($id){


		$sql = "UPDATE `messages` SET seen = 0
		WHERE message_id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	
	public function addMessage($conversation_id,$user_id,$message,$seen){


		$sql = "INSERT INTO messages (conversation_id, user_id, message, seen) VALUES (:conversation_id,:user_id, :message, :seen);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":conversation_id",$conversation_id);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":message",$message);
        $stmt->bindValue(":seen",$seen);

        if($stmt->execute()){

            return true;
        }
        return false;
	}
}