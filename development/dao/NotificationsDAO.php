<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class NotificationsDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function getNotificationsByUserId($user_id){

		$sql = 'SELECT n.notification_id,p.propo_id,u.id,u.firstname,q.quest_id,c.id AS community_id,n.notification_type,n.notification_creation_date,n.seen
				FROM notifications AS n
				LEFT OUTER JOIN proposals AS p
				ON p.propo_id = n.item_id
				LEFT OUTER JOIN users AS u
				on u.id = n.creator_user_id
				LEFT OUTER JOIN quests AS q
				on q.quest_id = n.item_id
				LEFT OUTER JOIN communities AS c
				on c.id = n.item_id
				WHERE n.user_id = :user_id
				GROUP BY n.notification_id
				ORDER BY n.notification_creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":user_id",$user_id);

		if($stmt->execute()){

			$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($quests)){

				return $quests;
			}

		}
		return array();
	}

//UPDATE `droopl`.`notifications` SET `seen` = '1' WHERE `notifications`.`notification_id` = 16;

	public function seenNotification($notification_id){

		$sql = "UPDATE `notifications` SET `seen` = '1' WHERE notification_id = :notification_id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":notification_id",$notification_id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function addNotification($user_id,$item_id,$notification_type,$creator_user_id){


		$sql = "INSERT INTO `notifications` (user_id, item_id,notification_type,creator_user_id, seen) VALUES (:user_id,:item_id,:notification_type,:creator_user_id,'0');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":item_id",$item_id);
        $stmt->bindValue(":notification_type",$notification_type);
        $stmt->bindValue(":creator_user_id",$creator_user_id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function removeItem($offer_id){

		$sql ="DELETE FROM `offers` WHERE `offer_id` = :offer_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':offer_id',$offer_id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}

}