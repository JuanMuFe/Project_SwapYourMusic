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
<<<<<<< HEAD
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
<<<<<<< HEAD
						
					case 7:	echo toDoClass::modifyItems($this->params['action'], $this->params['JSONItemToMod']);
							break;
							
					case 57: echo toDoClass::modifyUser($this->params['action'], $this->params['JSONData']);
							 break;
=======
=======
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
					case 55:	echo toDoClass::searchClientUsers($this->params['action']);
							break;
					case 56:	echo toDoClass::deleteUser($this->params['action'], $this->params['JSONData']);
							break;	
					case 57:	echo toDoClass::modifyUser($this->params['action'], $this->params['JSONData']);
							break;
								
>>>>>>> bc61bf70b022cf299088ddfb413396cc50106a05
>>>>>>> a6c8b172693d4e9ba978fdf974579bddb08b125a
							
					default: echo "Action ".$action." not correct in toDoClass.";
							 break;
				}
			}			
		}
	}
?>
