<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class FeedbackDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}
	public function addFeedback($user_id,$feedback,$type){


		$sql = "INSERT INTO `feedback` (user_id, feedback,type) VALUES (:user_id, :feedback,:type);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":feedback",$feedback);
        $stmt->bindValue(":type",$type);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

}