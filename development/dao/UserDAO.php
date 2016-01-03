<?php

require_once WWW_ROOT . 'classes' .DS. 'DatabasePDO.php';

class UserDAO{

	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function register($first,$last,$mail,$pass,$birth,$selected_lang,$gender,$picture,$street,$number,$zipcode,$city,$country,$latitude,$longitude){

		return $this->addUser($first,$last,$mail,$pass,$birth,$selected_lang,$gender,$picture,$street,$number,$zipcode,$city,$country,$latitude,$longitude);

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

	public function getUsers(){

		$sql = 'SELECT id,firstname,lastname,picture FROM users LIMIT 30';

		$stmt = $this->pdo->prepare($sql);
		if($stmt->execute()){

			return $illustrator = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return array();

	}



	public function getSearchUsers($entry){

		$sql = 'SELECT u.id,u.firstname,u.occupation,u.lastname,u.email,u.picture,u.age,u.street,u.nr,u.zipcode,u.city,u.occupation,u.number,u.status,u.verification,u.description,u.lang,u.latitude,u.longitude,(SUM(r.rating)/COUNT(r.rating)) AS rating,(
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
		FROM users u
		LEFT OUTER JOIN user_rating as r
		ON u.id = r.user_id
		WHERE CONCAT(u.firstname ," ", u.lastname) LIKE :entry OR u.firstname LIKE :entry2 OR u.lastname LIKE :entry3 OR u.email LIKE :entry4  GROUP BY u.id LIMIT 30 ';

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':entry',$entry."%");
		$stmt->bindValue(':entry2',$entry."%");
		$stmt->bindValue(':entry3',$entry."%");
		$stmt->bindValue(':entry4',$entry."%");

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

		$sql = 'SELECT u.id,u.firstname,u.password,u.occupation,u.lastname,u.email,u.picture,u.age,u.street,u.nr,u.zipcode,u.city,u.occupation,u.number,u.status,u.verification,u.description,u.lang,u.latitude,u.longitude,(SUM(r.rating)/COUNT(r.rating)) AS rating ,(
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
FROM users u
LEFT OUTER JOIN user_rating as r
ON u.id = r.user_id
WHERE u.id = :id
GROUP BY u.id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return $user = $stmt->fetch(PDO::FETCH_ASSOC);

		}

		return array();
	}

	public function verifyUser($id){


		$sql = "UPDATE `users` SET verification = '1' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$id);

        if($stmt->execute()){

            return true;
        }
        return false;
	}


	public function addUser($first,$last,$mail,$pass,$birth,$selected_lang,$gender,$picture,$street,$number,$zipcode,$city,$country,$latitude,$longitude){

		$sql = 'INSERT INTO `users` (`firstname`, `lastname`, `email`, `picture`, `age`, `gender`, `street`, `nr`, `zipcode`, `city`, `country`, `password`, `occupation`, `number`, `status`, `verification`, `description`, `lang`, `latitude`, `longitude`) VALUES (:firstname, :lastname, :email, :picture, :age, :gender, :street, :nr, :zipcode, :city, :country, :password, "No occupation", "No Number", "0", "0", "No Desciption", :lang, :latitude, :longitude);';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':firstname',$first);
		$stmt->bindValue(':lastname',$last);
		$stmt->bindValue(':email',$mail);
		$stmt->bindValue(':picture',$picture);
		$stmt->bindValue(':age',$birth);
		$stmt->bindValue(':gender',$gender);
		$stmt->bindValue(':street',$street);
		$stmt->bindValue(':nr',$number);
		$stmt->bindValue(':zipcode',$zipcode);
		$stmt->bindValue(':city',$city);
		$stmt->bindValue(':country',$country);
		$stmt->bindValue(':password',$pass);
		$stmt->bindValue(':lang',$selected_lang);
		$stmt->bindValue(':latitude',$latitude);
		$stmt->bindValue(':longitude',$longitude);


		if($stmt->execute()){

			return $this->getUserById($this->pdo->lastInsertId());

		}
		return false;
	}

}
