<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class FollowDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function checkFollow($user_id,$friend_id){


		$sql = 'SELECT *
		FROM `followers`
		WHERE user_id = :user_id AND friend_id = :friend_id';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':friend_id',$friend_id);

		if($stmt->execute()){

			return $follow = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		return array();

	}
	public function getFollowersByUserId($user_id)
	{
        $sql = 'SELECT f.follow_id , u.id, u.firstname ,u.lastname,u.picture,u.occupation,(
        SELECT COUNT(*)
        FROM   followers AS f
    	WHERE f.user_id = u.id
        ) AS followers,
        (
        SELECT COUNT(*)
        FROM   quests AS q
            WHERE q.user_id = u.id
        ) AS quests,
        (
        SELECT COUNT(*)
        FROM   proposals AS p
            WHERE p.user_id = u.id
        ) AS proposals
		FROM followers AS f
		LEFT OUTER JOIN users AS u
        on f.user_id = u.id
        WHERE f.friend_id = :user_id
        ORDER BY f.follow_creation_date DESC';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);

		if($stmt->execute()){

			return $follow = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return array();
	}

	public function getAllFollowers($user_id)
	{
        $sql = 'SELECT f.follow_id , u.id, u.firstname ,u.lastname,u.picture,u.occupation
        FROM   followers AS f
		LEFT OUTER JOIN users AS u
        on f.friend_id = u.id
        WHERE f.user_id = :user_id
        ORDER BY f.follow_creation_date DESC LIMIT 10 OFFSET 0';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);

		if($stmt->execute()){

			return $follow = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return array();
	}

	public function addFollow($user_id,$friend_id){


		$sql = "INSERT INTO `followers` (`user_id`, `friend_id`) VALUES (:user_id, :friend_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":friend_id",$friend_id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function removeFollow($user_id,$friend_id){

		$sql ="DELETE FROM `followers` WHERE user_id = :user_id AND friend_id = :friend_id;";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":friend_id",$friend_id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}

}