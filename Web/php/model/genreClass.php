<?php
/*
 * genreClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class genreClass {
    private $genreID;
    private $name;

    //----------Data base Values---------------------------------------
    private static $tableName = "genres";
    private static $colNameGenreID = "genreID";
    private static $colNameName = "name";
        
    function __construct() {
    }
    
    public function getGenreID() {
        return $this->genreID;
    }
    
    public function setGenreID($genreID) {
        $this->genreID = $genreID;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["genreID"] = $this->getGenreID();
		$data["name"] = $this->getName();

		return $data;
    }

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $genreID ,$name
	 * @return: none
	 */ 
    public function setAll($genreID ,$name) {
		$this->setGenreID($genreID);
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
		$entity = genreClass::fromResultSet( $row );
		
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
		$genreID=$res[genreClass::$colNameGenreID];
		$name=$res[genreClass::$colNameName];

       	//Object construction
       	$entity = new genreClass();
		$entity->setGenreID($genreID);
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

	return genreClass::fromResultSetList( $res );
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
    public static function findById( $genreID ) {
	$cons = "select * from `".genreClass::$tableName."` where ".genreClass::$colNameGenreID." = \"".$genreID."\"";

	return genreClass::findByQuery( $cons );
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
    	$cons = "select * from `".genreClass::$tableName."`";
		return genreClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".genreClass::$tableName."(`genreID`,`name`) values (?,?)" )) {
		$stmt->bind_param("is",$this->getGenreID(), $this->getName());
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
		if ($stmt->prepare("DELETE FROM `".genreClass::$tableName."` where ".genreClass::$colNameGenreID." = ?")) {
			$stmt->bind_param("i",$this->getGenreID());
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
		if ($stmt->prepare("update `".genreClass::$tableName."` set ".genreClass::$colNameGenreID." = ?,".genreClass::$colNameName." = ? where ".genreClass::$colNameGenreID." =?") ) {
			$stmt->bind_param("isi",$this->getGenreID(), $this->getName(),$this->getGenreID() );
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
        $toString = "genreClass[genreID=" . $this->genreID . "][name=" . $this->name . "]";
		return $toString;

    }
}
?>
