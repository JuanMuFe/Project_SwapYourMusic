<?php
/*
 * warningClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class warningClass {
    private $warningID;
    private $description;

    //----------Data base Values---------------------------------------
    private static $tableName = "warnings";
    private static $colNameWarningID = "warningID";
    private static $colNameDescription = "description";
        
    function __construct() {
    }
    
    public function getWarningID() {
        return $this->warningID;
    }
    
    public function setWarningID($warningID) {
        $this->warningID = $warningID;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["warningID"] = $this->getWarningID();
		$data["description"] = $this->getDescription();

	return $data;
    }

/*
     * @userDescription: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $warningID ,$description
	 * @return: none
	 */ 
    public function setAll($warningID ,$description) {
		$this->setWarningID($warningID);
		$this->setDescription($description);
    }
    
    //---Databese management section-----------------------
     /*
     * @userDescription: fromResultSetList()
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
		$entity = warningClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userDescription: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$warningID=$res[warningClass::$colNameWarningID];
		$description=$res[warningClass::$colNameDescription];

       	//Object construction
       	$entity = new warningClass();
		$entity->setWarningID($warningID);
		$entity->setDescription($description);


		return $entity;
    }

    /*
     * @userDescription: findByQuery()
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

	return warningClass::fromResultSetList( $res );
    }

    /*
     * @userDescription: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $warningID ) {
	$cons = "select * from `".warningClass::$tableName."` where ".warningClass::$colNameWarningID." = \"".$warningID."\"";

	return warningClass::findByQuery( $cons );
    }

 
    /*
     * @userDescription: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".warningClass::$tableName."`";
	return warningClass::findByQuery( $cons );
    }


	/*
     * @userDescription: create()
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
	if ($stmt->prepare("insert into ".warningClass::$tableName."(`warningID`,`description`) values (?,?)" )) {
		$stmt->bind_param("is",$this->getWarningID(), $this->getDescription());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userDescription: delete()
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
		if ($stmt->prepare("DELETE FROM `".warningClass::$tableName."` where ".warningClass::$colNameWarningID." = ?")) {
			$stmt->bind_param("i",$this->getWarningID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userDescription: update()
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
		if ($stmt->prepare("update `".warningClass::$tableName."` set ".warningClass::$colNameWarningID." = ?,".warningClass::$colNameDescription." = ? where ".warningClass::$colNameWarningID." =?") ) {
			$stmt->bind_param("isi",$this->getWarningID(), $this->getDescription(),$this->getWarningID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userDescription: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "warningClass[warningID=" . $this->warningID . "][description=" . $this->description . "]";
		return $toString;

    }
}
?>
