<?php
/**
 * Classe controlClass
 * controls all the possible actions to do
*/
require_once "toDoClass.php";

	class controlClass{
		private $params;
		
		function __construct($parameters) {
			$this->params = array();
			foreach ( $parameters as $n => $v){
				$this->params[$n] = $v;
			}
		}
		
		public function toDoAction(){
			if (isset($this->params['action'])){
				switch ($this->params['action']){
					
					case 1:	echo toDoClass::userConnection($this->params['action'], $this->params['JSONData']);
							break;						
					
					case 2: echo toDoClass::searchItemsByUser($this->params['action'], $this->params['userID']);
							break;
							
					case 3: echo toDoClass::searchGenres($this->params['action']);
							break;
							
					case 4: echo toDoClass::searchConditions($this->params['action']);
							break;
						
					case 5: echo toDoClass::insertItem($this->params['action'], $this->params['JSONData']);
							break;
						
					case 6:	echo toDoClass::deleteItem($this->params['action'], $this->params['JSONData']);
							break;
						
					case 7:	echo toDoClass::modifyItems($this->params['action'], $this->params['JSONItemToMod']);
							break;
							
					case 8: echo toDoClass::searchLimitedItems($this->params['action'], $this->params['limitNumber']);
							break;
					
					case 9: echo toDoClass::searchItems($this->params['action'], $this->params['itemType'], $this->params['genreID'], $this->params['artist']);
							break;	
							
					case 10: echo toDoClass::checkWarnings($this->params['action'], $this->params['userID']);
							 break;
					
					case 11: echo toDoClass::searchWarnings($this->params['action']);
							 break;
					
					case 12: echo toDoClass::modifyReadWarnings($this->params['action'], $this->params['warningsArray']);
							 break;	
							 
					case 13: echo toDoClass::loadUserFriends($this->params['action'], $this->params['userID']);
							 break;
					
					case 14: echo toDoClass::searchAllProvinces($this->params['action']);
							 break;	
					
					case 15: echo toDoClass::deleteFriend($this->params['action'], $this->params['friendToDelete']);
							 break;								
	
					case 50:	echo toDoClass::searchByUserName($this->params['action'], $this->params['JSONData']);
							break;		
					case 51:	echo toDoClass::searchByEmail($this->params['action'], $this->params['JSONData']);
							break;	
					case 52:	echo toDoClass::searchRegions($this->params['action']);
							break;	
					case 53:	echo toDoClass::searchProvincesByRegion($this->params['action'], $this->params['regionID']);
							break;		
					case 54:	echo toDoClass::insertUser($this->params['action'], $this->params['JSONData']);
							break;	
					case 55:	echo toDoClass::searchClientUsersNameLike($this->params['action'], $this->params['userName']);
							break;
					case 56:	echo toDoClass::deleteUser($this->params['action'], $this->params['JSONData']);
							break;	
					case 57:	echo toDoClass::modifyUser($this->params['action'], $this->params['JSONData']);
							break;
					case 58:	echo toDoClass::searchClientUsersByRegion($this->params['action'], $this->params['regionID']);
							break;
					case 59:	echo toDoClass::searchClientUsersByRegionLikeName($this->params['action'], $this->params['regionID'], $this->params['userName']);
							break;
					case 60:	echo toDoClass::searchAllWarnings($this->params['action']);
							break;
					case 61: 	echo toDoClass::insertWarningToUser($this->params['warningID'],$this->params['userID']);
							break;
					case 62:	echo toDoClass::insertWarning($this->params['JSONData']);
							break;
					case 63:	echo toDoClass::setWarningInactive($this->params['JSONData']);
							break;
					case 64:	echo toDoClass::modifyWarning($this->params['JSONData']);
							break;
					case 65:	echo toDoClass::searchBids();
							break;
					case 66:	echo toDoClass::searchBidHistory($this->params['bidID']);
							break;
					case 67:	echo toDoClass::searchWarningsByUser($this->params['userID']);
							break;
					case 68:	echo toDoClass::searchAllItems();
							break;
			
							
					default: echo "Action ".$action." not correct in toDoClass.";
							 break;
				}
			}			
		}
	}
?>
