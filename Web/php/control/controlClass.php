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
								
							
					default: echo "Action ".$action." not correct in toDoClass.";
							 break;
				}
			}			
		}
	}
?>
