<?php

require_once WWW_ROOT .'classes'. DS . 'DatabasePDO.php';

class PropoDAO
{
	public $pdo;

	public function __construct(){

		$this->pdo = DatabasePDO::getInstance();

	}
	public function getPropoCount()
	{
		$sql = 'SELECT COUNT(p.propo_id) AS propocount FROM proposals p WHERE p.propo_id > 0';
		$stmt = $this->pdo->prepare($sql);

		if($stmt->execute()){

			$propocount = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($propocount)){

				return $propocount;
			}

		}
		return array();
	}

	public function acceptProposal($propo_id,$quest_id)
	{
		$sql = "INSERT INTO accepted_propos (`propo_id`, `quest_id`) VALUES (:propo_id, :quest_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":quest_id",$quest_id);
        $stmt->bindValue(":propo_id",$propo_id);
        if($stmt->execute()){

            return true;
        }
        return false;
	}
	public function getAcceptedProposalByQuestId($quest_id){

		$sql = 'SELECT p.propo_id, c.item_name, c.collection_image , u.id, u.firstname ,u.lastname,u.picture
				FROM accepted_propos AS ap
                LEFT OUTER JOIN proposals AS p
                ON ap.propo_id = p.propo_id
				LEFT OUTER JOIN collection AS c
				ON p.collection_id = c.collection_id
				LEFT OUTER JOIN users AS u
						ON p.user_id = u.id	
				        WHERE ap.quest_id = :quest_id
				        GROUP BY p.propo_id
				        ORDER BY p.propo_creation_date ASC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':quest_id',$quest_id);

		if($stmt->execute()){

			$proposal = $stmt->fetch(PDO::FETCH_ASSOC);

			if(!empty($proposal)){

				return $proposal;
			}

		}
		return array();

	}
	
	public function getProposalsByQuestId($id){

		$sql = 'SELECT p.propo_id, c.item_name, c.collection_image , u.id, u.firstname ,u.lastname,u.picture
				FROM proposals AS p
				LEFT OUTER JOIN collection AS c
				ON p.collection_id = c.collection_id
				LEFT OUTER JOIN users AS u
						ON p.user_id = u.id	
				        WHERE p.quest_id = :id
				        GROUP BY p.propo_id
				        ORDER BY p.propo_creation_date ASC';
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id',$id);

		if($stmt->execute()){

			$proposals = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if(!empty($proposals)){

				return $proposals;
			}

		}
		return array();

	}


	public function addProposal($quest_id,$user_id,$collection_id){


		$sql = "INSERT INTO proposals (quest_id, user_id, collection_id) VALUES (:quest_id, :user_id, :collection_id);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":quest_id",$quest_id);
        $stmt->bindValue(":user_id",$user_id);
        $stmt->bindValue(":collection_id",$collection_id);
        if($stmt->execute()){

            return true;
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

}