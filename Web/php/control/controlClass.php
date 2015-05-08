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
							
					case 57: echo toDoClass::modifyUser($this->params['action'], $this->params['JSONData']);
							 break;
							
					default: echo "Action ".$action." not correct in toDoClass.";
							 break;
				}
			}			
		}
	}
?>
