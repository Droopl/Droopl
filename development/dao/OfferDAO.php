<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class OfferDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function getOffers(){

		$sql = 'SELECT * FROM `collection` ORDER BY `collection_creation_date` DESC';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($quests)){

				return $quests;
			}

		}
		return array();
	}

	public function addOffer($quest_id,$collection_id){


		$sql = "INSERT INTO `offers` (`quest_id`, `collection_id`) VALUES ( :quest_id, :collection_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":quest_id",$quest_id);
        $stmt->bindValue(":collection_id",$collection_id);

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
