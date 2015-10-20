<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class VerificationDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function getVerificationByUserId($user_id){

		$sql = 'SELECT * FROM `verification` WHERE user_id = :user_id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(":user_id",$user_id);

		if($stmt->execute()){

			$verification = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($verification)){

				return $verification;
			}

		}
		return array();
	}


	public function addVerification($user_id,$code){

		$sql = "INSERT INTO `verification` (`user_id`, `code`) VALUES ( :user_id, :code);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":code",$code);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

}