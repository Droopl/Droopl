<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class FeedDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}
	public function getQuestCount()
	{
		$sql = 'SELECT COUNT(q.quest_id) AS quest_count FROM quests q WHERE q.quest_id > 0';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$questcount = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($questcount)){

				return $questcount;
			}

		}
		return array();
	}
	public function getPublicQuests(){

		$sql = 'SELECT pq.id,q.quest_id,q.views,q.item,q.quest_description,q.creation_date ,q.type, COUNT(p.quest_id) AS propocount , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM public_quests AS pq
        LEFT OUTER JOIN quests AS q
		ON pq.quest_id = q.quest_id
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        GROUP BY q.quest_id
        ORDER BY q.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($quests)){

				return $quests;
			}

		}
		return array();
	}

	public function getQuestFromDistance($user_id,$lat,$long){

		$sql = 'SELECT f.follow_id,q.quest_id,q.views,q.item,q.quest_description,q.creation_date ,q.type, COUNT(p.quest_id) AS propocount ,SQRT(POW(69.1 *(u.latitude - :lat),2) + POW( 69.1 * (:long - u.longitude) * COS(u.latitude / 57.3),2)) AS distance , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM followers AS f
		LEFT OUTER JOIN public_quests AS pq
		ON f.friend_id = pq.user_id
		LEFT OUTER JOIN quests AS q
		ON pq.quest_id = q.quest_id
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE f.user_id = :user_id
        GROUP BY q.quest_id
        ORDER BY  distance ASC , q.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':user_id',$user_id);
		$stmt->bindValue(':lat',$lat);
		$stmt->bindValue(':long',$long);

		if($stmt->execute()){

			$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($quests)){

				return $quests;
			}

		}
		return array();
	}

	public function getQuests($user_id){

		$sql = 'SELECT pq.id,q.quest_id,q.views,q.item,q.quest_description,q.creation_date ,q.type, COUNT(p.quest_id) AS propocount , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM followers AS f
		LEFT OUTER JOIN public_quests AS pq
		ON f.friend_id = pq.user_id
		LEFT OUTER JOIN quests AS q
		ON pq.quest_id = q.quest_id
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE f.user_id = :user_id
        GROUP BY pq.id
        ORDER BY q.creation_date DESC';
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
	public function getQuestsByCommunity($community_id){

		$sql = 'SELECT q.quest_id,q.item,q.views,q.quest_description,q.creation_date ,q.type, COUNT(p.quest_id) AS propocount , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM community_quests AS cq
        LEFT OUTER JOIN quests AS q
		ON cq.quest_id = q.quest_id
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE cq.community_id = :community_id
        GROUP BY q.quest_id
        ORDER BY q.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':community_id',$community_id);

		if($stmt->execute()){

			$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($quests)){

				return $quests;
			}

		}
		return array();
	}
	public function getQuestsByViews($user_id){

		$sql = 'SELECT f.follow_id,q.views,q.quest_id,q.item,q.quest_description,q.creation_date ,q.type, COUNT(p.quest_id) AS propocount , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM followers AS f
		LEFT OUTER JOIN public_quests AS pq
		ON f.friend_id = pq.user_id
		LEFT OUTER JOIN quests AS q
		ON pq.quest_id = q.quest_id
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE f.user_id = :user_id
        GROUP BY q.quest_id
        ORDER BY q.views DESC';
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
	
	public function getQuestById($quest_id){

		$sql = 'SELECT q.quest_id,q.item,q.quest_description,q.creation_date ,q.type, u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_image,c.item_name,c.user_id,c.collection_id,c.collection_image,c.item_name,c.user_id
		FROM quests AS q
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE q.quest_id = :quest_id
        GROUP BY q.quest_id
        ORDER BY q.creation_date DESC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':quest_id',$quest_id);

		if($stmt->execute()){

			$quest = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($quest)){

				return $quest;
			}

		}
		return array();

	}
	public function updateViewById($quest_id)
	{

		$sql = "UPDATE quests set views = views+1 WHERE quest_id = :quest_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':quest_id',$quest_id);
		
		if($stmt->execute()){

            return true;
        }
        return false;
	}

	public function getSearchQuests($item){

			$sql = "SELECT q.quest_id,q.item,q.quest_description ,q.type , u.id,u.latitude,u.longitude, u.firstname ,u.lastname,u.picture
			FROM quests AS q
			LEFT OUTER JOIN users AS u
	        on q.user_id = u.id
	        WHERE q.item LIKE :item
	        GROUP BY q.quest_id
	        ORDER BY q.creation_date DESC";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':item',$item."%");
			if($stmt->execute()){

				$quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if(!empty($quests)){

					return $quests;

				}

			}
			return array();

		}

	public function getQuestByUserId($user_id){

			$sql = 'SELECT q.quest_id,q.item,q.quest_description,q.creation_date  ,q.type, COUNT(p.quest_id) AS propocount , u.id, u.firstname ,u.lastname,u.picture, i.image_url,c.collection_image,c.item_name,c.user_id
		FROM quests AS q
		LEFT OUTER JOIN proposals AS p
		ON q.quest_id = p.quest_id
		LEFT OUTER JOIN users AS u
        on q.user_id = u.id
        LEFT OUTER JOIN images AS i
        on q.quest_id = i.quest_id
        LEFT OUTER JOIN offers AS o
        on q.quest_id = o.quest_id
        LEFT OUTER JOIN collection AS c
        on o.collection_id = c.collection_id
        WHERE q.user_id = :user_id
        GROUP BY q.quest_id
        ORDER BY q.creation_date DESC';
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

		public function addPublicQuest($quest_id,$user_id){


			$sql = "INSERT INTO `public_quests` (`quest_id`, `user_id`) VALUES (:quest_id, :user_id);";
	        $stmt = $this->pdo->prepare($sql);
	        $stmt->bindValue(":quest_id",$quest_id);
	        $stmt->bindValue(":user_id",$user_id);

	        if($stmt->execute()){

				return $this->getQuestById($this->pdo->lastInsertId());

			}
	        return false;
		}

	public function addQuest($item,$user_id,$quest_description,$type,$active){


		$sql = "INSERT INTO `quests` (`item`, `user_id`, `quest_description`, `type`, `active`) VALUES (:item, :user_id, :quest_description, :type, :active);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":item",$item);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":quest_description",$quest_description);
        $stmt->bindValue(":type",$type);
        $stmt->bindValue(":active",$active);

        if($stmt->execute()){

			return $this->getQuestById($this->pdo->lastInsertId());

		}
        return false;
	}

	public function removeEvent($id){

		$sql ="DELETE FROM `rsvp_events` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			return true;
		}

		return false;
	}
    
    public function getActivity(){
        
        
        
    }

}