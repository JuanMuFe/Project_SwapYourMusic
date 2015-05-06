<?php
/*
 * conditionClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class conditionClass {
    private $conditionID;
    private $name;

    //----------Data base Values---------------------------------------
    private static $tableName = "conditions";
    private static $colNameConditionID = "conditionID";
    private static $colNameName = "name";
        
    function __construct() {
    }
    
    public function getConditionID() {
        return $this->conditionID;
    }
    
    public function setConditionID($conditionID) {
        $this->conditionID = $conditionID;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["conditionID"] = $this->getConditionID();
		$data["name"] = $this->getName();

	return $data;
    }

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $conditionID ,$name
	 * @return: none
	 */ 
    public function setAll($conditionID ,$name) {
		$this->setConditionID($conditionID);
		$this->setName($name);
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
		$entity = conditionClass::fromResultSet( $row );
		
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
		$conditionID=$res[conditionClass::$colNameConditionID];
		$name=$res[conditionClass::$colNameName];

       	//Object construction
       	$entity = new conditionClass();
		$entity->setConditionID($conditionID);
		$entity->setName($name);


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

	return conditionClass::fromResultSetList( $res );
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
    public static function findById( $conditionID ) {
	$cons = "select * from `".conditionClass::$tableName."` where ".conditionClass::$colNameConditionID." = \"".$conditionID."\"";

	return conditionClass::findByQuery( $cons );
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
    	$cons = "select * from `".conditionClass::$tableName."`";
		return conditionClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".conditionClass::$tableName."(`conditionID`,`name`) values (?,?)" )) {
		$stmt->bind_param("is",$this->getConditionID(), $this->getName());
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
		if ($stmt->prepare("DELETE FROM `".conditionClass::$tableName."` where ".conditionClass::$colNameConditionID." = ?")) {
			$stmt->bind_param("i",$this->getConditionID());
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
		if ($stmt->prepare("update `".conditionClass::$tableName."` set ".conditionClass::$colNameConditionID." = ?,".conditionClass::$colNameName." = ? where ".conditionClass::$colNameConditionID." =?") ) {
			$stmt->bind_param("isi",$this->getConditionID(), $this->getName(),$this->getConditionID() );
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
        $toString = "conditionClass[conditionID=" . $this->conditionID . "][name=" . $this->name . "]";
		return $toString;

    }
}
?>
