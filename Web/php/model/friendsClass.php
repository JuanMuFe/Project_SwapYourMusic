<?php
/*
 * friendsClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @userID: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class friendsClass {
    private $friendID;
    private $userID;

    //----------Data base Values---------------------------------------
    private static $tableName = "friends";
    private static $colNameFriendID = "friendID";
    private static $colNameUserID = "userID";
        
    function __construct() {
    }
    
    public function getFriendID() {
        return $this->friendID;
    }
    
    public function setFriendID($friendID) {
        $this->friendID = $friendID;
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
  
	
    public function getAll() {
		$data = array();
		$data["friendID"] = $this->getFriendID();
		$data["userID"] = $this->getUserID();

	return $data;
    }

/*
     * @userUserID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @userID: this functions sets all the object params
	 * @params: $friendID ,$userID
	 * @return: none
	 */ 
    public function setAll($userID, $friendID) {
		$this->setFriendID($friendID);
		$this->setUserID($userID);
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
		$entity = friendsClass::fromResultSet( $row );
		
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
		$friendID=$res[friendsClass::$colNameFriendID];
		$userID=$res[friendsClass::$colNameUserID];

       	//Object construction
       	$entity = new friendsClass();
		$entity->setFriendID($friendID);
		$entity->setUserID($userID);


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

	return friendsClass::fromResultSetList( $res );
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
		$cons = "select * from `".friendsClass::$tableName."` where ".friendsClass::$colNameUserID." = \"".$userID."\"";

		return friendsClass::findByQuery( $cons );
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
    	$cons = "select * from `".friendsClass::$tableName."`";
	return friendsClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".friendsClass::$tableName."(`friendID`,`userID`) values (?,?)" )) {
		$stmt->bind_param("ii",$this->getFriendID(), $this->getUserID());
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
		if ($stmt->prepare("DELETE FROM `".friendsClass::$tableName."` where ".friendsClass::$colNameFriendID." = ? and".friendsClass::$colNameUserID." = ?")) {
			$stmt->bind_param("ii",$this->getFriendID(),$this->getUserID());
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
		if ($stmt->prepare("update `".friendsClass::$tableName."` set ".friendsClass::$colNameFriendID." = ?,".friendsClass::$colNameUserID." = ? where ".friendsClass::$colNameFriendID." =? and".friendsClass::$colNameUserID." = ?") ) {
			$stmt->bind_param("iiii",$this->getFriendID(), $this->getUserID(),$this->getFriendID(),$this->getUserID() );
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
        $toString = "friendsClass[friendID=" . $this->friendID . "][userID=" . $this->userID . "]";
		return $toString;

    }
}
?>
