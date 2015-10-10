<?php

require_once WWW_ROOT . 'classes' .DS. 'DatabasePDO.php';

class UserDAO{

	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function register($lastName,$name,$email,$password,$picture){

		return $this->addUser($lastName,$name,$email,$password,$picture);

	}
	public function getUserCount()
	{
		$sql = 'SELECT COUNT(u.id) AS usercount FROM users u WHERE u.id > 0';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$usercount = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($usercount)){

				return $usercount;
			}

		}
		return array();
	}
	

	public function getSearchUsers($entry){

		$sql = 'SELECT *
		FROM `users`
		WHERE firstname LIKE :entry OR lastname LIKE :entry2 OR email LIKE :entry3';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':entry',$entry."%");
		$stmt->bindValue(':entry2',$entry."%");
		$stmt->bindValue(':entry3',$entry."%");

		if($stmt->execute()){

			return $illustrator = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return array();

	}

	public function loginUser($email,$password){

		$sql = 'SELECT *
		FROM `users`
		WHERE email = :email AND password = :password';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':email',$email);
		$stmt->bindValue(':password',$password);

		if($stmt->execute()){

			return $user = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		return array();

	}


	public function getUserById($id){

		$sql = 'SELECT u.id,u.firstname,u.lastname,u.email,u.picture,u.age,u.street,u.nr,u.zipcode,u.city,u.occupation,u.number,u.status,u.verification,u.description,u.lang,u.latitude,u.longitude,(SUM(r.rating)/COUNT(r.rating)) AS rating  
FROM users u
LEFT OUTER JOIN user_rating as r
ON r.user_id = u.id
WHERE u.id = :id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return $user = $stmt->fetch(PDO::FETCH_ASSOC);

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