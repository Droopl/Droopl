<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class UserRatingDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function checkRated($user_id,$creator_id){

		$sql = 'SELECT *
		FROM `user_rating`
		WHERE user_id = :user_id AND creator_id = :creator_id';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':creator_id',$creator_id);

		if($stmt->execute()){

			return $follow = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		return array();

	}

	public function addRating($user_id,$creator_id,$rating){

		$sql = "INSERT INTO `user_rating` (user_id, creator_id,rating) VALUES (:user_id,:creator_id,:rating);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":creator_id",$creator_id);
        $stmt->bindValue(":rating",$rating);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

}