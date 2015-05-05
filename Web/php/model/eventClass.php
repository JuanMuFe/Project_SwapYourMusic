<?php
/*
 * eventClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class eventClass {
    private $eventID;
    private $name;
    private $description;
	private $date;
	private $place;

    //----------Data base Values---------------------------------------
    private static $tableName = "events";
    private static $colNameEventID = "eventID";
    private static $colNameName = "name";
    private static $colNameDescription = "description";
    private static $colNameDate = "date";
    private static $colNamePlace = "place";
        
    function __construct() {
    }
    
    public function getEventID() {
        return $this->eventID;
    }
    
    public function setEventID($eventID) {
        $this->eventID = $eventID;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
     public function getDescription() {
        return $this->description;
    }
    
    public function setDescirption($description) {
        $this->description = $description;
    }
    
     public function getDate() {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }
    
     public function getPlace() {
        return $this->place;
    }
    
    public function setPlace($place) {
        $this->place = $place;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["eventID"] = $this->getRegionID();
		$data["name"] = $this->getName();
		$data["description"] = $this->getDescription();
		$data["place"] = $this->getPlace();
		$data["date"] = $this->getDate();

	return $data;
    }

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $eventID ,$name
	 * @return: none
	 */ 
    public function setAll($eventID ,$name, $description, $date, $place)) {
		$this->setRegionID($eventID);
		$this->setName($name);
		$this->setDescirption($description);
		$this->setDate($date);
		$this->setPlace($place);
    }
    
    //---Databese management section-----------------------
     /*
     * @userName: fromResultSetList()
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
		$entity = eventClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userName: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$eventID=$res[eventClass::$colNameEventID];
		$name=$res[eventClass::$colNameName];
		$description=$res[eventClass::$colNameDescription];
		$date=$res[eventClass::$colNameDate];
		$place=$res[eventClass::$colNamePlace];

       	//Object construction
       	$entity = new eventClass();
		$entity->setRegionID($eventID);
		$entity->setName($name);
		$entity->setDescirption($description);
		$entity->setDate($date);
		$entity->setPlace($place);


		return $entity;
    }

    /*
     * @userName: findByQuery()
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

	return eventClass::fromResultSetList( $res );
    }

    /*
     * @userName: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $eventID ) {
	$cons = "select * from `".eventClass::$tableName."` where ".eventClass::$colNameEventID." = \"".$eventID."\"";

	return eventClass::findByQuery( $cons );
    }

 
    /*
     * @userName: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".eventClass::$tableName."`";
	return eventClass::findByQuery( $cons );
    }


	/*
     * @userName: create()
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
	if ($stmt->prepare("insert into ".eventClass::$tableName."(`eventID`,`name`, `description`, `date`, `place`) values (?,?,?,?,?)" )) {
		$stmt->bind_param("issss",$this->getEventID(), $this->getName(), $this->getDescription(), $this->getDate(), $this->getPlace());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userName: delete()
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
		if ($stmt->prepare("DELETE FROM `".eventClass::$tableName."` where ".eventClass::$colNameEventID." = ?")) {
			$stmt->bind_param("i",$this->getEventID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userName: update()
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
		if ($stmt->prepare("update `".eventClass::$tableName."` set ".eventClass::$colNameEventID." = ?,".eventClass::$colNameName." = ?,".eventClass::$colNameDescription." = ?,".eventClass::$colNameDate." = ?,".eventClass::$colNamePlace." = ? where ".eventClass::$colNameEventID." =?") ) {
			$stmt->bind_param("issssi",$this->getEventID(), $this->getName(),$this->getDescription(),$this->getDate(),$this->getPlace(),$this->getEventID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userName: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "eventClass[eventID=" . $this->eventID . "][name=" . $this->name . "][description=" . $this->description . "][date=" . $this->date . "][place=" . $this->place . "]";
		return $toString;

    }
}
?>
