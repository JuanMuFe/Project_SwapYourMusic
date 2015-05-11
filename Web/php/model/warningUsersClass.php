<?php
/*
 * warningUsersClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @userID: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class warningUsersClass {
    private $warningID;
    private $userID;
    private $read;

    //----------Data base Values---------------------------------------
    private static $tableName = "warnings_users";
    private static $colNameWarningID = "warningID";
    private static $colNameUserID = "userID";
    private static $colNameRead = "read";
        
    function __construct() {
    }
    
    public function getWarningID() {
        return $this->warningID;
    }
    
    public function setWarningID($warningID) {
        $this->warningID = $warningID;
    }
    

    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getRead() {
        return $this->read;
    }
    
    
    public function setRead($read) {
        $this->read = $read;
    }
  
	
    public function getAll() {
		$data = array();
		$data["warningID"] = $this->getWarningID();
		$data["userID"] = $this->getUserID();
		$data["read"] = $this->getRead();

	return $data;
    }

/*
     * @userUserID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this functions sets all the object params
	 * @params: $warningID ,$userID
	 * @return: none
	 */ 
    public function setAll($warningID ,$userID, $read) {
		$this->setWarningID($warningID);
		$this->setUserID($userID);
		$this->setRead($read);
    }
    
    //---Databese management section-----------------------
     /*
     * @userUserID: fromResultSetList()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this function runs a query and returns an array with all the result transformed into an object
     * @date: 27/03/2015
	 * @params: res query to execute
	 * @return: objects collection
	 */ 
    private static function fromResultSetList( $res ) {
	$entityList = array();
	$i=0;
	while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
		//We get all the values an add into the array
		$entity = warningUsersClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userUserID: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$warningID=$res[warningUsersClass::$colNameWarningID];
		$userID=$res[warningUsersClass::$colNameUserID];
		$read=$res[warningUsersClass::$colNameRead];

       	//Object construction
       	$entity = new warningUsersClass();
		$entity->setWarningID($warningID);
		$entity->setUserID($userID);
		$entity->setUserID($read);


		return $entity;
    }

    /*
     * @userUserID: findByQuery()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @userID: this function runs a particular query and returns the result
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

	return warningUsersClass::fromResultSetList( $res );
    }

    /*
     * @userUserID: findByUserId()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @userID: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByUserId( $userID ) {
	$cons = "select * from `".warningUsersClass::$tableName."` where ".warningUsersClass::$colNameUserID." = \"".$userID."\"";

	return warningUsersClass::findByQuery( $cons );
    }

 
    /*
     * @userUserID: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @userID: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".warningUsersClass::$tableName."`";
	return warningUsersClass::findByQuery( $cons );
    }


	/*
     * @userUserID: create()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this function inserts a new row to the database
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
	if ($stmt->prepare("insert into ".warningUsersClass::$tableName."(`warningID`,`userID`,`read`) values (?,?,?)" )) {
		$stmt->bind_param("iii",$this->getWarningID(), $this->getUserID(),$this->getRead());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userUserID: delete()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this function deletes a row into the database
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
		if ($stmt->prepare("DELETE FROM `".warningUsersClass::$tableName."` where ".warningUsersClass::$colNameWarningID." = ? and".warningUsersClass::$colNameUserID." = ?")) {
			$stmt->bind_param("ii",$this->getWarningID(),$this->getUserID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userUserID: update()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this function updates a row into the database
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
		if ($stmt->prepare("update `".warningUsersClass::$tableName."` set ".warningUsersClass::$colNameWarningID." = ?,".warningUsersClass::$colNameUserID." = ? where ".warningUsersClass::$colNameWarningID." =? and".warningUsersClass::$colNameUserID." = ?") ) {
			$stmt->bind_param("iiii",$this->getWarningID(), $this->getUserID(),$this->getWarningID(),$this->getUserID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    
    /*
     * @userUserID: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "warningUsersClass[warningID=" . $this->warningID . "][userID=" . $this->userID . "][read=" . $this->read . "]";
		return $toString;

    }
}
?>
