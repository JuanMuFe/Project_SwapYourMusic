<?php
/*
 * swapClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @success: php class of the object
 * @startDate: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class swapClass {
    private $swapID;
    private $startDate;
	private $finishDate;
    private $success;


    //----------Data base Values---------------------------------------
    private static $tableName = "swaps";
    private static $colNameSwapID = "swapID";
    private static $colNameStartDate = "startDate";
    private static $colNameFinishDate = "finishDate";
    private static $colNameSuccess = "success";
    
        
    function __construct() {
    }
    
    public function getSwapID() {
        return $this->swapID;
    }
    
    public function setSwapID($swapID) {
        $this->swapID = $swapID;
    }
    
    public function getStartDate() {
        return $this->startDate;
    }
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
  
     public function getFinishDate() {
        return $this->finishDate;
    }
    
    public function setFinishDate($finishDate) {
        $this->finishDate = $finishDate;
    }

    
     public function getSuccess() {
        return $this->success;
    }
    
    public function setSuccess($success) {
        $this->success = $success;
    }
    
    
  
	
    public function getAll() {
		$data = array();
		$data["swapID"] = $this->getRegionID();
		$data["startDate"] = $this->getStartDate();
		$data["finishDate"] = $this->getFinishDate();
		$data["success"] = $this->getSuccess();
		

	return $data;
    }

/*
     * @userStartDate: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this functions sets all the object params
	 * @params: $swapID ,$startDate
	 * @return: none
	 */ 
    public function setAll($swapID ,$startDate, $finishDate, $success) {
		$this->setRegionID($swapID);
		$this->setStartDate($startDate);
		$this->setFinishDate($finishDate);
		$this->setSuccess($success);

    }
    
    //---Databese management section-----------------------
     /*
     * @userStartDate: fromResultSetList()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this function runs a query and returns an array with all the result transformed into an object
     * @startDate: 27/03/2015
	 * @params: res query to execute
	 * @return: objects collection
	 */ 
    private static function fromResultSetList( $res ) {
	$entityList = array();
	$i=0;
	while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
		//We get all the values an add into the array
		$entity = swapClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userStartDate: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: the query result is transformed into an object
     * @startDate: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$swapID=$res[swapClass::$colNameSwapID];
		$startDate=$res[swapClass::$colNameStartDate];
		$finishDate=$res[swapClass::$colNameFinishDate];
		$success=$res[swapClass::$colNameSuccess];		
		

       	//Object construction
       	$entity = new swapClass();
		$entity->setRegionID($swapID);
		$entity->setStartDate($startDate);
		$entity->setFinishDate($finishDate);
		$entity->setSuccess($success);
		
		
		return $entity;
    }

    /*
     * @userStartDate: findByQuery()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @success: this function runs a particular query and returns the result
     * @startDate: 27/03/2015
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

	return swapClass::fromResultSetList( $res );
    }

    /*
     * @userStartDate: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @success: this function runs a query and returns an object array
     * @startDate: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $swapID ) {
	$cons = "select * from `".swapClass::$tableName."` where ".swapClass::$colNameSwapID." = \"".$swapID."\"";

	return swapClass::findByQuery( $cons );
    }

 
    /*
     * @userStartDate: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @success: this function runs a query and returns an object array
     * @startDate: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".swapClass::$tableName."`";
	return swapClass::findByQuery( $cons );
    }


	/*
     * @userStartDate: create()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this function inserts a new row to the database
     * @startDate: 27/03/2015
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
	if ($stmt->prepare("insert into ".swapClass::$tableName."(`swapID`,`startDate`, `finishDate`, `success`) values (?,?,?,?)" )) {
		$stmt->bind_param("issi",$this->getSwapID(), $this->getStartDate(), $this->getFinishDate(), $this->getSuccess());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userStartDate: delete()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this function deletes a row into the database
     * @startDate: 27/03/2015
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
		if ($stmt->prepare("DELETE FROM `".swapClass::$tableName."` where ".swapClass::$colNameSwapID." = ?")) {
			$stmt->bind_param("i",$this->getSwapID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userStartDate: update()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this function upstartDates a row into the database
     * @startDate: 27/03/2015
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
		if ($stmt->prepare("UPDATE `".swapClass::$tableName."` set ".swapClass::$colNameSwapID." = ?,".swapClass::$colNameStartDate." = ?,".swapClass::$colNameFinishDate." = ?,".swapClass::$colNameSuccess." = ? where ".swapClass::$colNameSwapID." =?") ) {
			$stmt->bind_param("issii",$this->getSwapID(), $this->getStartDate(),$this->getFinishDate(),$this->getSuccess(),$this->getSwapID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userStartDate: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @success: this function converts to string the object
     * @startDate: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "swapClass[swapID=" . $this->swapID . "][startDate=" . $this->startDate . "][finishDate=" . $this->finishDate . "][success=" . $this->success . "]";
		return $toString;

    }
}
?>
