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
    private $userID;
    private $swapID;
    private $itemID;

    //----------Data base Values---------------------------------------
    private static $tableName = "applications";
    private static $colNameUserID = "userID";
    private static $colNameSwapID = "swapID";
    private static $colNameItemID = "itemID";
        
    function __construct() {
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getSwapID() {
        return $this->swapID;
    }
    
    public function setSwapID($swapID) {
        $this->swapID = $swapID;
    }
    
     public function getItemID() {
        return $this->itemID;
    }
    
    public function setItemID($itemID) {
        $this->itemID = $itemID;
    }
  
	
    public function getAll() {
	$data = array();
	$data["userID"] = $this->getUserID();
	$data["swapID"] = $this->getSwapID();
	$data["itemID"] = $this->getItemID();

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
    public function setAll($userID ,$swapID, $itemID)) {
		$this->setUserID($userID);
		$this->setSwapID($swapID);
		$this->setItemID($itemID);
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
		$userID=$res[applicationsClass::$colNameUserID];
		$swapID=$res[applicationsClass::$colNameSwapID];
		$itemID=$res[applicationsClass::$colNameItemID];


       	//Object construction
       	$entity = new applicationsClass();
		$entity->setUserID($userID);
		$entity->setSwapID($swapID);
		$entity->setItemID($itemID);


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
    public static function findById( $userID ) {
	$cons = "select * from `".applicationsClass::$tableName."` where ".applicationsClass::$colNameUserID." = \"".$userID."\"";

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
	if ($stmt->prepare("insert into ".applicationsClass::$tableName."(`userID`,`swapID`,`itemID`) values (?,?,?)" )) {
		$stmt->bind_param("iii",$this->getUserID(), $this->getSwapID(),$this->getItemID());
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
		if ($stmt->prepare("DELETE FROM `".applicationsClass::$tableName."` where ".applicationsClass::$colNameUserID." = ? and ".applicationsClass::$colNameSwapID." = ?")) {
			$stmt->bind_param("ii",$this->getUserID(), this->getSwapID());
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
		if ($stmt->prepare("update `".applicationsClass::$tableName."` set ".applicationsClass::$colNameUserID." = ?,".applicationsClass::$colNameSwapID." = ?,".applicationsClass::$colNameItemID." = ? where ".applicationsClass::$colNameUserID." =? and ".applicationsClass::$colNameSwapID." = ?") ) {
			$stmt->bind_param("iiiii",$this->getUserID(), $this->getSwapID(),$this->getItemID(),$this->getUserID(), $this->getSwapID() );
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
        $toString = "applicationsClass[userID=" . $this->userID . "][swapID=" . $this->swapID . "][itemID=" . $this->itemID."]";
		return $toString;

    }
}
?>
