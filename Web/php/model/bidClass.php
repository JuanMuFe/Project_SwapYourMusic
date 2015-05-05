<?php
/*
 * bidClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @duration: php class of the object
 * @startDate: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class bidClass {
    private $bidID;
    private $startPrice;
    private $duration;
	private $startDate;
	private $finishDate;

    //----------Data base Values---------------------------------------
    private static $tableName = "bids";
    private static $colNameBidID = "bidID";
    private static $colNameStartPrice = "startPrice";
    private static $colNameDuration = "duration";
    private static $colNameStartDate = "startDate";
    private static $colNameFinishDate = "finishDate";
        
    function __construct() {
    }
    
    public function getBidID() {
        return $this->bidID;
    }
    
    public function setBidID($bidID) {
        $this->bidID = $bidID;
    }
    
    public function getStartPrice() {
        return $this->startPrice;
    }
    
    public function setStartPrice($startPrice) {
        $this->startPrice = $startPrice;
    }
    
     public function getDuration() {
        return $this->duration;
    }
    
    public function setDescirption($duration) {
        $this->duration = $duration;
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
    
  
	
    public function getAll() {
		$data = array();
		$data["bidID"] = $this->getRegionID();
		$data["startPrice"] = $this->getStartPrice();
		$data["duration"] = $this->getDuration();
		$data["finishDate"] = $this->getFinishDate();
		$data["startDate"] = $this->getStartDate();

	return $data;
    }

/*
     * @userStartPrice: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this functions sets all the object params
	 * @params: $bidID ,$startPrice
	 * @return: none
	 */ 
    public function setAll($bidID ,$startPrice, $duration, $startDate, $finishDate)) {
		$this->setRegionID($bidID);
		$this->setStartPrice($startPrice);
		$this->setDescirption($duration);
		$this->setStartDate($startDate);
		$this->setFinishDate($finishDate);
    }
    
    //---Databese management section-----------------------
     /*
     * @userStartPrice: fromResultSetList()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this function runs a query and returns an array with all the result transformed into an object
     * @startDate: 27/03/2015
	 * @params: res query to execute
	 * @return: objects collection
	 */ 
    private static function fromResultSetList( $res ) {
	$entityList = array();
	$i=0;
	while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
		//We get all the values an add into the array
		$entity = bidClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userStartPrice: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: the query result is transformed into an object
     * @startDate: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$bidID=$res[bidClass::$colNameBidID];
		$startPrice=$res[bidClass::$colNameStartPrice];
		$duration=$res[bidClass::$colNameDuration];
		$startDate=$res[bidClass::$colNameStartDate];
		$finishDate=$res[bidClass::$colNameFinishDate];

       	//Object construction
       	$entity = new bidClass();
		$entity->setRegionID($bidID);
		$entity->setStartPrice($startPrice);
		$entity->setDescirption($duration);
		$entity->setStartDate($startDate);
		$entity->setFinishDate($finishDate);


		return $entity;
    }

    /*
     * @userStartPrice: findByQuery()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @duration: this function runs a particular query and returns the result
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

	return bidClass::fromResultSetList( $res );
    }

    /*
     * @userStartPrice: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @duration: this function runs a query and returns an object array
     * @startDate: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $bidID ) {
	$cons = "select * from `".bidClass::$tableName."` where ".bidClass::$colNameBidID." = \"".$bidID."\"";

	return bidClass::findByQuery( $cons );
    }

 
    /*
     * @userStartPrice: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @duration: this function runs a query and returns an object array
     * @startDate: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".bidClass::$tableName."`";
	return bidClass::findByQuery( $cons );
    }


	/*
     * @userStartPrice: create()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this function inserts a new row to the database
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
	if ($stmt->prepare("insert into ".bidClass::$tableName."(`bidID`,`startPrice`, `duration`, `startDate`, `finishDate`) values (?,?,?,?,?)" )) {
		$stmt->bind_param("issss",$this->getBidID(), $this->getStartPrice(), $this->getDuration(), $this->getStartDate(), $this->getFinishDate());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userStartPrice: delete()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this function deletes a row into the database
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
		if ($stmt->prepare("DELETE FROM `".bidClass::$tableName."` where ".bidClass::$colNameBidID." = ?")) {
			$stmt->bind_param("i",$this->getBidID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userStartPrice: update()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this function upstartDates a row into the database
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
		if ($stmt->prepare("UPDATE `".bidClass::$tableName."` set ".bidClass::$colNameBidID." = ?,".bidClass::$colNameStartPrice." = ?,".bidClass::$colNameDuration." = ?,".bidClass::$colNameStartDate." = ?,".bidClass::$colNameFinishDate." = ? where ".bidClass::$colNameBidID." =?") ) {
			$stmt->bind_param("iiissi",$this->getBidID(), $this->getStartPrice(),$this->getDuration(),$this->getStartDate(),$this->getFinishDate(),$this->getBidID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userStartPrice: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @duration: this function converts to string the object
     * @startDate: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "bidClass[bidID=" . $this->bidID . "][startPrice=" . $this->startPrice . "][duration=" . $this->duration . "][startDate=" . $this->startDate . "][finishDate=" . $this->finishDate . "]";
		return $toString;

    }
}
?>
