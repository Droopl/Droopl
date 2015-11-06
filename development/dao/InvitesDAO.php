<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class InvitesDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function addInvite($user_id,$community_id){


		$sql = "INSERT INTO `invites` (`user_id`, `community_id`,`accepted`) VALUES (:user_id, :community_id, '0');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":community_id",$community_id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function getAllFollowersForInvite($user_id,$query){
        $sql = 'SELECT f.follow_id , u.id, u.firstname ,u.lastname,u.picture,u.occupation,i.accepted
				FROM   followers AS f
				LEFT OUTER JOIN users AS u
				on f.friend_id = u.id AND u.firstname LIKE :search
				LEFT OUTER JOIN invites AS i
				on u.id = i.user_id

				WHERE f.user_id = :user_id
                GROUP BY u.id
				ORDER BY u.id DESC LIMIT 10 OFFSET 0';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':search',"%".$query."%");

		if($stmt->execute()){

			return $follow = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return array();
	}

	public function checkInvite($user_id,$community_id){


		$sql = 'SELECT *
		FROM `invites`
		WHERE user_id = :user_id AND community_id = :community_id';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return $invited = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		return array();

	}


}