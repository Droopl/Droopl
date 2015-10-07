<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class CollectionDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function getCollection(){

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
	
	public function getCollectionById($collection_id){

		$sql = 'SELECT * FROM collection WHERE collection_id =:collection_id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':collection_id',$collection_id);

		if($stmt->execute()){

			$item = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($item)){

				return $item;
			}

		}
		return array();

	}

	public function getCollectionByUserId($user_id){

			$sql = 'SELECT * FROM `collection` WHERE user_id =:user_id ORDER BY `collection_creation_date` DESC';
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_id',$user_id);

			if($stmt->execute()){

				$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if(!empty($quests)){

					return $quests;
				}

			}
			return array();

		}


	public function addItem($item_name,$user_id,$description,$collection_image){


		$sql = "INSERT INTO `collection` (`item_name`, `user_id`, `description`, `collection_image`, `status`) VALUES ( :item_name, :user_id, :description, :collection_image,'0');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":item_name",$item_name);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":description",$description);
        $stmt->bindValue(":collection_image",$collection_image);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function removeItem($collection_id){

		$sql ="DELETE FROM `collection` WHERE `collection_id` = :collection_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':collection_id',$collection_id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}

}