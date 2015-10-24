<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class ImagesDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}


	public function addImage($quest_id,$image_url){


		$sql = "INSERT INTO `images` (`quest_id`, `image_url`) VALUES (:quest_id, :image_url);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":quest_id",$quest_id);
        $stmt->bindValue(":image_url",$image_url);

        if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function removeImage($id){

		$sql ="DELETE FROM `images` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}

}