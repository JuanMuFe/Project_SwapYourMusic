<?php
/*
 * provinceClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class provinceClass {
    private $provinceID;
    private $name;
    private $regionID;

    //----------Data base Values---------------------------------------
    private static $tableName = "provinces";
    private static $colNameProvinceID = "provinceID";
    private static $colNameName = "name";
    private static $colNameRegionID = "regionID";
        
    function __construct() {
    }
    
    public function getProvinceID() {
        return $this->provinceID;
    }
    
    public function setProvinceID($provinceID) {
        $this->provinceID = $provinceID;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
     public function getRegionID() {
        return $this->regionID;
    }
    
    public function setRegionID($regionID) {
        $this->regionID = $regionID;
    }
  
	
    public function getAll() {
	$data = array();
	$data["provinceID"] = $this->getProvinceID();
	$data["name"] = UTF8_encode($this->getName());
	$data["regionID"] = $this->getRegionID();

	return $data;
    }

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $provinceID ,$name
	 * @return: none
	 */ 
    public function setAll($provinceID ,$name, $regionID) {
		$this->setProvinceID($provinceID);
		$this->setName($name);
		$this->setRegionID($regionID);
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
		$entity = provinceClass::fromResultSet( $row );
		
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
		$provinceID=$res[provinceClass::$colNameProvinceID];
		$name=$res[provinceClass::$colNameName];
		$regionID=$res[provinceClass::$colNameRegionID];


       	//Object construction
       	$entity = new provinceClass();
		$entity->setProvinceID($provinceID);
		$entity->setName($name);
		$entity->setRegionID($regionID);


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

	return provinceClass::fromResultSetList( $res );
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
    public static function findById( $provinceID ) {
	$cons = "select * from `".provinceClass::$tableName."` where ".provinceClass::$colNameProvinceID." = \"".$provinceID."\"";

	return provinceClass::findByQuery( $cons );
    }

   /*
     * @userName: findProvincesByRegion()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findProvincesByRegion( $regionID ) {
	$cons = "select * from `".provinceClass::$tableName."` where ".provinceClass::$colNameRegionID." = \"".$regionID."\"";

	return provinceClass::findByQuery( $cons );
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
    	$cons = "select * from `".provinceClass::$tableName."`";
	return provinceClass::findByQuery( $cons );
    }

	    /*
     * @userName: findByRegionID()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByRegionID($regionID) {
	$cons = "select * from `".provinceClass::$tableName."` where ".provinceClass::$colNameRegionID." = \"".$regionID."\"";

	return provinceClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".provinceClass::$tableName."(`provinceID`,`name`,`regionID`) values (?,?,?)" )) {
		$stmt->bind_param("isi",$this->getProvinceID(), $this->getName(),$this->getRegionID());
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
		if ($stmt->prepare("DELETE FROM `".provinceClass::$tableName."` where ".provinceClass::$colNameProvinceID." = ?")) {
			$stmt->bind_param("i",$this->getProvinceID());
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
		if ($stmt->prepare("update `".provinceClass::$tableName."` set ".provinceClass::$colNameProvinceID." = ?,".provinceClass::$colNameName." = ?,".provinceClass::$colNameRegionID." = ? where ".provinceClass::$colNameProvinceID." =?") ) {
			$stmt->bind_param("isii",$this->getProvinceID(), $this->getName(),$this->getRegionID(),$this->getProvinceID() );
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
        $toString = "provinceClass[provinceID=" . $this->provinceID . "][name=" . $this->name . "][regionID=" . $this->regionID."]";
		return $toString;

    }
}
?>
