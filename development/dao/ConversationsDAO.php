<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class ConversationsDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function getConversationById($conversation_id,$user_id){

		$sql = 'SELECT c.conversation_id,c.conversation_name,cu.user_id,cu.user_typing
		FROM conversation AS c
		LEFT OUTER JOIN conversation_users AS cu
        on cu.user_id = (
           SELECT x.user_id
FROM conversation_users AS x 
WHERE x.conversation_id = c.conversation_id AND x.user_id != :user_id
GROUP BY x.conversation_id      
        )
        WHERE c.conversation_id = :conversation_id
        GROUP BY c.conversation_id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':conversation_id',$conversation_id);
		$stmt->bindValue(':user_id',$user_id);

		if($stmt->execute()){

			$conversation = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($conversation)){

				return $conversation;
			}

		}
		return array();
	}
	

}