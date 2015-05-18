<?php
/*
 * applicationsClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class applicationsClass {
    private $swapID;
    private $offeredItemID;
    private $demandedItemID;

    //----------Data base Values---------------------------------------
    private static $tableName = "applications";
    private static $colNameSwapID = "swapID";
    private static $colNameOfferedItemID = "offeredItemID";
    private static $colNameDemandedItemID = "demandedItemID";
        
    function __construct() {
    }
        
    public function getSwapID() {
        return $this->swapID;
    }
    
    public function setSwapID($swapID) {
        $this->swapID = $swapID;
    }
    
     public function getOfferedItemID() {
        return $this->offeredItemID;
    }
    
    public function setOfferedItemID($offeredItemID) {
        $this->offeredItemID = $offeredItemID;
    }
    
     public function getDemandedItemID() {
        return $this->demandedItemID;
    }
    
    public function setDemandedItemID($demandedItemID) {
        $this->demandedItemID = $demandedItemID;
    }
  
	
    public function getAll() {
		$data = array();
		$data["swapID"] = $this->getSwapID();
		$data["offeredItemID"] = $this->getOfferedItemID();
		$data["demandedItemID"] = $this->getDemandedItemID();

		return $data;
    }

/*
     * @userSwapID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userID ,$swapID
	 * @return: none
	 */ 
    public function setAll($swapID, $offeredItemID, $demandedItemID) {
		$this->setSwapID($swapID);
		$this->setOfferedItemID($offeredItemID);
		$this->setDemandedItemID($demandedItemID);
    }
    
    //---Databese management section-----------------------
     /*
     * @userSwapID: fromResultSetList()
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
			$entity = applicationsClass::fromResultSet( $row );
			
			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    /*
     * @userSwapID: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$swapID=$res[applicationsClass::$colNameSwapID];
		$offeredItemID=$res[applicationsClass::$colNameOfferedItemID];
		$demandedItemID=$res[applicationsClass::$colNameDemandedItemID];


       	//Object construction
       	$entity = new applicationsClass();
		$entity->setSwapID($swapID);
		$entity->setOfferedItemID($offeredItemID);
		$entity->setDemandedItemID($demandedItemID);


		return $entity;
    }

    /*
     * @userSwapID: findByQuery()
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

		return applicationsClass::fromResultSetList( $res );
    }

    /*
     * @userSwapID: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $swapID ) {
		$cons = "select * from `".applicationsClass::$tableName."` where ".applicationsClass::$colNameSwapID." = \"".$swapID."\"";

		return applicationsClass::findByQuery( $cons );
    }

 
    /*
     * @userSwapID: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".applicationsClass::$tableName."`";
	return applicationsClass::findByQuery( $cons );
    }


	/*
     * @userSwapID: create()
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
		if ($stmt->prepare("insert into ".applicationsClass::$tableName."(`swapID`,`offeredItemID`, `demandedItemID`) values (?,?,?)" )) {
			$stmt->bind_param("iii",$this->getSwapID(), $this->getOfferedItemID(),$this->getDemandedItemID());
			//executar consulta
			$stmt->execute();
		}
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userSwapID: delete()
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
		if ($stmt->prepare("DELETE FROM `".applicationsClass::$tableName."` where ".applicationsClass::$colNameSwapID." = ?")) {
			$stmt->bind_param("i", $this->getSwapID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userSwapID: update()
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
		if ($stmt->prepare("update `".applicationsClass::$tableName."` set ".applicationsClass::$colNameSwapID." = ?,".applicationsClass::$colNameOfferedItemID." = ?,".applicationsClass::$colNameDemandedItemID."= ? where ".applicationsClass::$colNameSwapID." =?") ) {
			$stmt->bind_param("iiii",$this->getSwapID(),$this->getOfferedItemID(),$this->getDemandedItemID(), $this->getSwapID());
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userSwapID: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "applicationsClass [swapID=" . $this->swapID . "][Offered itemID=" . $this->offeredItemID."][Demaded itemID=".$this->demandedItemID."]";
		return $toString;

    }
}
?>
