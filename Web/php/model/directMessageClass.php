<?php
/*
 * directMessageClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @content: php class of the object
 * @swapID: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class directMessageClass {
    private $messageID;
    private $swapID;
	private $date;
    private $content;
    private $read;


    //----------Data base Values---------------------------------------
    private static $tableName = "direct_message";
    private static $colNameMessageID = "messageID";
    private static $colNameSwapID = "swapID";
    private static $colNameDate = "date";
    private static $colNameContent = "content";
    private static $colNameRead = "read";
    
        
    function __construct() {
    }
    
    public function getMessageID() {
        return $this->messageID;
    }
    
    public function setMessageID($messageID) {
        $this->messageID = $messageID;
    }
    
    public function getSwapID() {
        return $this->swapID;
    }
    
    public function setSwapID($swapID) {
        $this->swapID = $swapID;
    }
  
     public function getDate() {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }

    
     public function getContent() {
        return $this->content;
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
     public function getRead() {
        return $this->read;
    }
    
    public function setRead($read) {
        $this->read = $read;
    }
    
    
  
	
    public function getAll() {
		$data = array();
		$data["messageID"] = $this->getRegionID();
		$data["swapID"] = $this->getSwapID();
		$data["date"] = $this->getDate();
		$data["content"] = $this->getContent();
		$data["read"]= $this->getRead();

		return $data;
    }

/*
     * @userSwapID: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this functions sets all the object params
	 * @params: $messageID ,$swapID
	 * @return: none
	 */ 
    public function setAll($messageID ,$swapID, $date, $content, $read) {
		$this->setMessageID($messageID);
		$this->setSwapID($swapID);
		$this->setDate($date);
		$this->setContent($content);
		$this->setRead($read);
    }
    
    //---Databese management section-----------------------
     /*
     * @userSwapID: fromResultSetList()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this function runs a query and returns an array with all the result transformed into an object
     * @swapID: 27/03/2015
	 * @params: res query to execute
	 * @return: objects collection
	 */ 
    private static function fromResultSetList( $res ) {
	$entityList = array();
	$i=0;
	while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
		//We get all the values an add into the array
		$entity = directMessageClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userSwapID: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: the query result is transformed into an object
     * @swapID: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$messageID=$res[directMessageClass::$colNameMessageID];
		$swapID=$res[directMessageClass::$colNameSwapID];
		$date=$res[directMessageClass::$colNameDate];
		$content=$res[directMessageClass::$colNameContent];		
		$read= $res[directMessageClass::$colNameRead];

       	//Object construction
       	$entity = new directMessageClass();
		$entity->setRegionID($messageID);
		$entity->setSwapID($swapID);
		$entity->setDate($date);
		$entity->setContent($content);
		$entity->setRead($read);
		
		return $entity;
    }

    /*
     * @userSwapID: findByQuery()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @content: this function runs a particular query and returns the result
     * @swapID: 27/03/2015
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

	return directMessageClass::fromResultSetList( $res );
    }

    /*
     * @userSwapID: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @content: this function runs a query and returns an object array
     * @swapID: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $messageID ) {
	$cons = "select * from `".directMessageClass::$tableName."` where ".directMessageClass::$colNameMessageID." = \"".$messageID."\"";

	return directMessageClass::findByQuery( $cons );
    }

 
    /*
     * @userSwapID: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @content: this function runs a query and returns an object array
     * @swapID: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".directMessageClass::$tableName."`";
	return directMessageClass::findByQuery( $cons );
    }


	/*
     * @userSwapID: create()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this function inserts a new row to the database
     * @swapID: 27/03/2015
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
		if ($stmt->prepare("insert into ".directMessageClass::$tableName."(`messageID`,`swapID`, `content`, `read`) values (?,?,?,?)" )) {
			$stmt->bind_param("iisi",$this->getMessageID(), $this->getSwapID(), $this->getContent(), $this->getRead());
			//executar consulta
			$stmt->execute();
			}
			
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userSwapID: delete()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this function deletes a row into the database
     * @swapID: 27/03/2015
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
		if ($stmt->prepare("DELETE FROM `".directMessageClass::$tableName."` where ".directMessageClass::$colNameMessageID." = ?")) {
			$stmt->bind_param("i",$this->getMessageID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userSwapID: update()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this function upswapIDs a row into the database
     * @swapID: 27/03/2015
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
		if ($stmt->prepare("UPDATE `".directMessageClass::$tableName."` set ".directMessageClass::$colNameMessageID." = ?,".directMessageClass::$colNameSwapID." = ?,".directMessageClass::$colNameDate." = ?,".directMessageClass::$colNameContent." = ?, ".directMessageClass::$colNameRead."=? where ".directMessageClass::$colNameMessageID." =?") ) {
			$stmt->bind_param("iisis",$this->getMessageID(), $this->getSwapID(),$this->getDate(),$this->getContent(), $this->getRead(), $this->getMessageID());
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userSwapID: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @content: this function converts to string the object
     * @swapID: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "directMessageClass[messageID=" . $this->messageID . "][swapID=" . $this->swapID . "][date=" . $this->date . "][content=" . $this->content . "]";
		return $toString;

    }
}
?>
