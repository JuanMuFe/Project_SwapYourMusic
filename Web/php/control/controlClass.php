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
						
							
					default: echo "Action ".$action." not correct in toDoClass.";
							 break;
				}
			}			
		}
	}
	
	/*
     * @itemType: findUserWarnings()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this function finds warnings
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function findUserWarnings(){
		$cons = "select * from `".itemClass::$tableName."` order by ".itemClass::$colNameUploadDate." DESC limit ".$limitNumber;
		return itemClass::findByQuery( $cons );
    }
?>
