<?php

require_once WWW_ROOT . 'classes' .DS. 'DatabasePDO.php';

class CommunityDAO{

	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}
	
	public function getCommunityById($id){

		$sql = 'SELECT *
		FROM communities
		WHERE id = :id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return $user = $stmt->fetch(PDO::FETCH_ASSOC);

		}

		return array();
	}
	public function getCommunitiesByUserId($user_id){

		$sql = 'SELECT cu.community_id,c.community_name FROM community_users AS cu
		LEFT OUTER JOIN users AS u
		on cu.user_id = u.id
		LEFT OUTER JOIN communities AS c
		on cu.community_id = c.id
		WHERE cu.user_id = :user_id
		ORDER BY cu.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);

		if($stmt->execute()){

			return $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		return array();
	}

	public function getCommunityUsersById($community_id){

		$sql = 'SELECT * FROM community_users AS cu
		LEFT OUTER JOIN users AS u
		on cu.user_id = u.id
		WHERE cu.community_id = :community_id
		ORDER BY cu.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		return array();
	}

	public function addUser($ip){

		$sql = 'INSERT INTO`user` (`ip`)
		VALUES (:ip)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':ip',$ip);

		if($stmt->execute()){

			return $this->getUserById($this->pdo->lastInsertId());

		}
		return false;
	}

}