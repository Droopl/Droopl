<?php

require_once WWW_ROOT . 'classes' .DS. 'DatabasePDO.php';

class CommunityDAO{

	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}

	public function getCommunityCount()
	{
		$sql = 'SELECT COUNT(id) AS groupcount FROM communities  WHERE id > 0';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$groupcount = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($groupcount)){

				return $groupcount;
			}

		}
		return 0;
	}

	public function getCommunityById($id){

		$sql = 'SELECT c.id,c.community_name,c.community_profile,c.genre,c.creator_id,c.description,c.privacy,c.creation_date,(
        SELECT COUNT(*)
        FROM   community_quests AS cq
    	WHERE cq.community_id = c.id
        ) AS quests,(
        SELECT COUNT(*)
        FROM   community_users AS cu
    	WHERE cu.community_id = c.id
        ) AS members,(
        SELECT COUNT(*)
        FROM   proposals AS p
        LEFT OUTER JOIN community_quests as cq
		ON cq.quest_id = p.quest_id
        ) AS propos
		FROM communities c
		WHERE c.id = :id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return $user = $stmt->fetch(PDO::FETCH_ASSOC);

		}

		return array();
	}
	public function getCommunitiesByUserId($user_id){

		$sql = 'SELECT cu.community_id,c.community_profile,(
        SELECT COUNT(*)
        FROM community_users AS cuu
            WHERE cuu.community_id = cu.community_id
        ) AS usercount,c.community_name FROM community_users AS cu
		LEFT OUTER JOIN users AS u
		ON cu.user_id = u.id
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
	public function getAllCommunities(){

		$sql = 'SELECT c.id,c.community_name,c.community_profile,c.genre,c.creator_id,c.description,c.privacy,c.creation_date,(
        SELECT COUNT(*)
        FROM   community_quests AS cq
    	WHERE cq.community_id = c.id
        ) AS quests,(
        SELECT COUNT(*)
        FROM   community_users AS cu
    	WHERE cu.community_id = c.id
        ) AS members,(
        SELECT COUNT(*)
        FROM   proposals AS p
        LEFT OUTER JOIN community_quests as cq
		ON cq.quest_id = p.quest_id
        ) AS propos
        FROM communities c ORDER BY c.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			return $communities = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		return array();
	}
	public function addCommuntyUser($user_id,$community_id){

		$sql = 'INSERT INTO`community_users` (user_id,community_id)
		VALUES (:user_id,:community_id)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return true;

		}
		return false;
	}

	public function addCommunity($community_name,$community_profile,$creator_id,$description,$privacy){

		$sql = 'INSERT INTO`communities` (community_name,community_profile,genre,creator_id,description,privacy)
		VALUES (:community_name,:community_profile,0,:creator_id,:description,:privacy)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':community_name',$community_name);
		$stmt->bindValue(':community_profile',$community_profile);
		$stmt->bindValue(':creator_id',$creator_id);
		$stmt->bindValue(':description',$description);
		$stmt->bindValue(':privacy',$privacy);

		if($stmt->execute()){

			return $this->getCommunityById($this->pdo->lastInsertId());

		}
		return array();
	}

	public function isMemberOfCommunity($user_id,$community_id){

		$sql = 'SELECT id FROM community_users
		WHERE user_id = :user_id AND community_id = :community_id';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return $users = $stmt->fetch(PDO::FETCH_ASSOC);

		}

		return array();
	}

	public function getCommunityUsersById($community_id){

		$sql = 'SELECT * FROM community_users AS cu
		LEFT OUTER JOIN users AS u
		on cu.user_id = u.id
		WHERE cu.community_id = :community_id
		ORDER BY cu.creation_date ASC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		return array();
	}

	public function addCommuntyQuest($quest_id,$community_id){

		$sql = 'INSERT INTO`community_quests` (quest_id,community_id)
		VALUES (:quest_id,:community_id)';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':quest_id',$quest_id);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return true;

		}
		return false;
	}

	public function leaveMember($user_id,$community_id){

		$sql ="DELETE FROM community_users WHERE user_id = :user_id AND community_id = :community_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}

}
