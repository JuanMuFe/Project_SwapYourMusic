<?php
/*
 * eventsAssistanceClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class eventsAssistanceClass {
    private $userID;
    private $eventID;

    //----------Data base Values---------------------------------------
    private static $tableName = "events_assistance";
    private static $colNameUserID = "userID";
    private static $colNameEventID = "eventID";
        
    function __construct() {
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getEventID() {
        return $this->eventID;
    }
    
    public function setEventID($eventID) {
        $this->eventID = $eventID;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["userID"] = $this->getUserID();
		$data["eventID"] = $this->getEventID();

	return $data;
    }

/*
     * @userEventID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userID ,$eventID
	 * @return: none
	 */ 
    public function setAll($userID ,$eventID)) {
		$this->setUserID($userID);
		$this->setEventID($eventID);
    }
    
    //---Databese management section-----------------------
     /*
     * @userEventID: fromResultSetList()
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
		$entity = eventsAssistanceClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userEventID: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$userID=$res[eventsAssistanceClass::$colNameUserID];
		$eventID=$res[eventsAssistanceClass::$colNameEventID];

       	//Object construction
       	$entity = new eventsAssistanceClass();
		$entity->setUserID($userID);
		$entity->setEventID($eventID);


		return $entity;
    }

    /*
     * @userEventID: findByQuery()
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

	return eventsAssistanceClass::fromResultSetList( $res );
    }

    /*
     * @userEventID: findByEventId()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByEventId( $eventID ) {
	$cons = "select * from `".eventsAssistanceClass::$tableName."` where ".eventsAssistanceClass::$colNameEventID." = \"".$eventID."\"";

	return eventsAssistanceClass::findByQuery( $cons );
    }

 
    /*
     * @userEventID: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".eventsAssistanceClass::$tableName."`";
	return eventsAssistanceClass::findByQuery( $cons );
    }


	/*
     * @userEventID: create()
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
	if ($stmt->prepare("insert into ".eventsAssistanceClass::$tableName."(`userID`,`eventID`) values (?,?)" )) {
		$stmt->bind_param("is",$this->getUserID(), $this->getEventID());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userEventID: delete()
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
		if ($stmt->prepare("DELETE FROM `".eventsAssistanceClass::$tableName."` where ".eventsAssistanceClass::$colNameUserID." = ? and".eventsAssistanceClass::$colNameEventID." = ?")) {
			$stmt->bind_param("ii",$this->getUserID(), $this->getEventID);
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userEventID: update()
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
		if ($stmt->prepare("update `".eventsAssistanceClass::$tableName."` set ".eventsAssistanceClass::$colNameUserID." = ?,".eventsAssistanceClass::$colNameEventID." = ? where ".eventsAssistanceClass::$colNameUserID." =? and".eventsAssistanceClass::$colNameEventID." = ?") ) {
			$stmt->bind_param("iiii",$this->getUserID(), $this->getEventID(),$this->getUserID(),$this->getEventID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userEventID: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "eventsAssistanceClass[userID=" . $this->userID . "][eventID=" . $this->eventID . "]";
		return $toString;

    }
}
?>
