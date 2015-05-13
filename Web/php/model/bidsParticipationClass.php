<?php
/*
 * bidsParticipationClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class bidsParticipationClass {
    private $userID;
    private $bidID;
    private $offeredMoney;

    //----------Data base Values---------------------------------------
    private static $tableName = "bids_participation";
    private static $colNameUserID = "userID";
    private static $colNameBidID = "bidID";
    private static $colNameOfferedMoney = "offeredMoney";
        
    function __construct() {
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getBidID() {
        return $this->bidID;
    }
    
    public function setBidID($bidID) {
        $this->bidID = $bidID;
    }
    
     public function getOfferedMoney() {
        return $this->offeredMoney;
    }
    
    public function setOfferedMoney($offeredMoney) {
        $this->offeredMoney = $offeredMoney;
    }
  
	
    public function getAll() {
	$data = array();
	$data["userID"] = $this->getUserID();
	$data["bidID"] = $this->getBidID();
	$data["offeredMoney"] = $this->getOfferedMoney();

	return $data;
    }

/*
     * @userBidID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userID ,$bidID
	 * @return: none
	 */ 
    public function setAll($userID ,$bidID, $offeredMoney) {
		$this->setUserID($userID);
		$this->setBidID($bidID);
		$this->setOfferedMoney($offeredMoney);
    }
    
    //---Databese management section-----------------------
     /*
     * @userBidID: fromResultSetList()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function runs a query and returns an array with all the result transformed into an object
     * @date: 27/03/2015
	 * @params: res query to execute
	 * @return: objects collection
	 */ 
    private static function fromResultSetList( $res ) {
	$entityList = array();
	$i=0;
	while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
		//We get all the values an add into the array
		$entity = bidsParticipationClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userBidID: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$userID=$res[bidsParticipationClass::$colNameUserID];
		$bidID=$res[bidsParticipationClass::$colNameBidID];
		$offeredMoney=$res[bidsParticipationClass::$colNameOfferedMoney];


       	//Object construction
       	$entity = new bidsParticipationClass();
		$entity->setUserID($userID);
		$entity->setBidID($bidID);
		$entity->setOfferedMoney($offeredMoney);


		return $entity;
    }

    /*
     * @userBidID: findByQuery()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a particular query and returns the result
     * @date: 27/03/2015
	 * @params: cons query to run
	 * @return: objects collection
	 */ 
    public static function findByQuery( $cons ) {
	//Connection with the database
	$conn = new BDSwap_your_music();
	if (mysqli_connect_errno()) {
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
	}
	
	//Run the query
	$res = $conn->query($cons);
	
	if ( $conn != null ) $conn->close();

	return bidsParticipationClass::fromResultSetList( $res );
    }

    /*
     * @userBidID: findByBidId()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByBidID( $bidID ) {
	$cons = "select * from `".bidsParticipationClass::$tableName."` where ".bidsParticipationClass::$colNameBidID." = \"".$bidID."\"";

	return bidsParticipationClass::findByQuery( $cons );
    }

 
    /*
     * @userBidID: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".bidsParticipationClass::$tableName."`";
	return bidsParticipationClass::findByQuery( $cons );
    }


	/*
     * @userBidID: create()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function inserts a new row to the database
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function create() {
	//Connection with the database
	$conn = new BDSwap_your_music();
	if (mysqli_connect_errno()) {
   		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
	}
	//return $this->toString();
	//Preparing the sentence
	$stmt = $conn->stmt_init();
	if ($stmt->prepare("insert into ".bidsParticipationClass::$tableName."(`userID`,`bidID`,`offeredMoney`) values (?,?,?)" )) {
		$stmt->bind_param("iid",$this->getUserID(), $this->getBidID(),$this->getOfferedMoney());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userBidID: delete()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function deletes a row into the database
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function delete() {
		//Connection with the database
		$conn = new BDSwap_your_music();
		if (mysqli_connect_errno()) {
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
		}
		
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("DELETE FROM `".bidsParticipationClass::$tableName."` where ".bidsParticipationClass::$colNameUserID." = ? and".eventsAssistanceClass::$colNameBidID." = ? and".eventsAssistanceClass::$colNameOfferedMoney." = ?")) {
			$stmt->bind_param("iid",$this->getUserID(), $this->getBidID(), $this->getOfferedMoney());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userBidID: update()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function updates a row into the database
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function update() {
		//Connection with the database
		$conn = new BDSwap_your_music();
		if (mysqli_connect_errno()) {
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
		}
		
		//Preparing the sentence
		//return $this->toString();
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("update `".bidsParticipationClass::$tableName."` set ".bidsParticipationClass::$colNameUserID." = ?,".bidsParticipationClass::$colNameBidID." = ?,".bidsParticipationClass::$colNameOfferedMoney." = ? where ".bidsParticipationClass::$colNameUserID." =?and".eventsAssistanceClass::$colNameBidID." = ? and".eventsAssistanceClass::$colNameOfferedMoney." = ?") ) {
			$stmt->bind_param("iidiid",$this->getUserID(), $this->getBidID(),$this->getOfferedMoney(),$this->getUserID(),$this->getBidID(), $this->getOfferedMoney());
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userBidID: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "bidsParticipationClass[userID=" . $this->userID . "][bidID=" . $this->bidID . "][offeredMoney=" . $this->offeredMoney."]";
		return $toString;

    }
}
?>
