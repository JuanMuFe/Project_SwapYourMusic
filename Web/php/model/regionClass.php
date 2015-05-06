<?php
/*
 * regionClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class regionClass {
    private $regionID;
    private $name;

    //----------Data base Values---------------------------------------
    private static $tableName = "regions";
    private static $colNameRegionID = "regionID";
    private static $colNameName = "name";
        
    function __construct() {
    }
    
    public function getRegionID() {
        return $this->regionID;
    }
    
    public function setRegionID($regionID) {
        $this->regionID = $regionID;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["regionID"] = $this->getRegionID();
		$data["name"] = UTF8_encode($this->getName());

	return $data;
    }

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $regionID ,$name
	 * @return: none
	 */ 
    public function setAll($regionID ,$name) {
		$this->setRegionID($regionID);
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
		$entity = regionClass::fromResultSet( $row );
		
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
		$regionID=$res[regionClass::$colNameRegionID];
		$name=$res[regionClass::$colNameName];

       	//Object construction
       	$entity = new regionClass();
		$entity->setRegionID($regionID);
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

	return regionClass::fromResultSetList( $res );
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
    public static function findById( $regionID ) {
	$cons = "select * from `".regionClass::$tableName."` where ".regionClass::$colNameRegionID." = \"".$regionID."\"";

	return regionClass::findByQuery( $cons );
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
    	$cons = "select * from `".regionClass::$tableName."`";
	return regionClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".regionClass::$tableName."(`regionID`,`name`) values (?,?)" )) {
		$stmt->bind_param("is",$this->getRegionID(), $this->getName());
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
		if ($stmt->prepare("DELETE FROM `".regionClass::$tableName."` where ".regionClass::$colNameRegionID." = ?")) {
			$stmt->bind_param("i",$this->getRegionID());
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
		if ($stmt->prepare("update `".regionClass::$tableName."` set ".regionClass::$colNameRegionID." = ?,".regionClass::$colNameName." = ? where ".regionClass::$colNameRegionID." =?") ) {
			$stmt->bind_param("isi",$this->getRegionID(), $this->getName(),$this->getRegionID() );
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
        $toString = "regionClass[regionID=" . $this->regionID . "][name=" . $this->name . "]";
		return $toString;

    }
}
?>
