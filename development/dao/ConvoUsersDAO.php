<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class ConvoUsersDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function getConversationByUserId($user_id,$searchquery){

		$sql = 'SELECT c.conversation_id,c.conversation_name,u.id,u.firstname ,m.message,m.user_id,m.seen,m.message_creation_date,u.lastname,u.picture
		FROM conversation_users AS cu
        LEFT OUTER JOIN conversation AS c
        on cu.conversation_id = c.conversation_id
		LEFT OUTER JOIN users AS u
        on u.id = (
           SELECT x.user_id
FROM conversation_users AS x
WHERE x.conversation_id = cu.conversation_id AND x.user_id != :check_id
GROUP BY x.conversation_id
        )
        LEFT OUTER JOIN messages AS m
        on c.conversation_id = m.conversation_id AND m.message_creation_date =
        (
           SELECT MAX(r.message_creation_date) FROM conversation_users AS k LEFT OUTER JOIN messages AS r ON r.conversation_id = k.conversation_id WHERE k.conversation_id = cu.conversation_id
        )
        WHERE CONCAT(u.firstname ," ", u.lastname) LIKE :entry AND cu.user_id = :user_id
        GROUP BY cu.id
        ORDER BY m.message_creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':check_id',$user_id);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':entry',$searchquery."%");

		if($stmt->execute()){

			$conversations = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($conversations)){

				return $conversations;
			}

		}
		return array();
	}

	public function getUserByConversationId($conversation_id){

		$sql = 'SELECT cu.user_id ,u.firstname,u.lastname,u.picture,cu.user_typing
FROM conversation_users AS cu
LEFT OUTER JOIN users AS u
ON u.id = cu.user_id
WHERE cu.conversation_id = :conversation_id
ORDER BY cu.user_typing DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':conversation_id',$conversation_id);

		if($stmt->execute()){

			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($users)){

				return $users;
			}

		}
		return array();
	}

	public function addConversationUser($conversation_id,$user_id){


		$sql = "INSERT INTO conversation_users (conversation_id, user_id) VALUES (:conversation_id, :user_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":conversation_id",$conversation_id);
        $stmt->bindValue(":user_id",$user_id);
        if($stmt->execute()){

            return true;
        }
        return false;
	}


	public function typingConversation($conversation_id,$user_id,$typing){

		$sql = "UPDATE conversation_users  SET conversation_users.user_typing = :typing  WHERE conversation_users.user_id = :user_id AND conversation_users.conversation_id = :conversation_id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":conversation_id",$conversation_id);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":typing",$typing);

        if($stmt->execute()){

            return true;
        }
        return false;
	}


}
