<?php
/*
 * swapViewClass.php
 * @artist: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class swapViewClass {
    private $swapID;
    private $itemOfferedID;
    private $itemDemandedID;
    private $demandedUserName;
    private $offeredUserName;
    private $startDate;
    private $finishDate;
    private $success;

    //----------Data base Values---------------------------------------
    private static $tableName = "swapView";
    private static $colNameSwapID = "swapID";
    private static $colNameItemOfferedID = "itemOfferedID";
    private static $colNameItemDemandedID = "itemDemandedID";
    private static $colNameDemandedUserName = "demandedUserName";
    private static $colNameOfferedUserName = "offeredUserName";
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
    
    public function getItemOfferedID() {
        return $this->itemOfferedID;
    }
    
    public function setItemOfferedID($itemOfferedID) {
        $this->itemOfferedID = $itemOfferedID;
    }
    
    public function getItemDemandedID() {
        return $this->itemDemandedID;
    }
    
    public function setItemDemandedID($itemDemandedID) {
        $this->itemDemandedID = $itemDemandedID;
    }
    
    public function getDemandedUserName() {
        return $this->demandedUserName;
    }
    
    public function setDemandedUserName($demandedUserName) {
        $this->demandedUserName = $demandedUserName;
    }
    
    public function getOfferedUserName() {
        return $this->offeredUserName;
    }
    
    public function setOfferedUserName($offeredUserName) {
        $this->offeredUserName = $offeredUserName;
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
		$data["swapID"] = $this->getSwapID();
		$data["itemOfferedID"] = $this->getItemOfferedID();
		$data["itemDemandedID"] = $this->getItemDemandedID();
		$data["demandedUserName"] = $this->getDemandedUserName();
		$data["offeredUserName"] = $this->getOfferedUserName();
		$data["startDate"] = $this->getStartDate();
		$data["finishDate"] = $this->getFinishDate();
		$data["success"] = $this->getSuccess();
		
		return $data;
    }

/*
     * @itemType: setAll()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userName ,$startPrice, $itemType, $title,$title,$artist, $releaseYear,$duration,$image
	 * @return: none
	 */ 
    public function setAll($swapID ,$itemOfferedID, $itemDemandedID, $demandedUserName,$offeredUserName,$startDate, $finishDate,$success){
		$this->setSwapID($swapID);
		$this->setItemOfferedID($itemOfferedID);
		$this->setItemDemandedID($itemDemandedID);
		$this->setDemandedUserName($demandedUserName);
		$this->setOfferedUserName($offeredUserName);
		$this->setStartDate($startDate);
		$this->setFinishDate($finishDate);
		$this->setSuccess($success);
    }
    
    //---Databese management section-----------------------
     /*
     * @itemType: fromResultSetList()
	 * @artist: Irene Blanco
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
			$entity = swapViewClass::fromResultSet( $row );
			
			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    /*
     * @itemType: fromResultSet()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$swapID=$res[swapViewClass::$colNameSwapID];
		$itemOfferedID=$res[swapViewClass::$colNameItemOfferedID];
		$itemDemandedID=$res[swapViewClass::$colNameItemDemandedID];
		$demandedUserName = $res[ swapViewClass::$colNameDemandedUserName ];
		$offeredUserName=$res[swapViewClass::$colNameOfferedUserName];
		$startDate=$res[swapViewClass::$colNameStartDate];
		$finishDate=$res[swapViewClass::$colNameFinishDate];
		$success=$res[swapViewClass::$colNameSuccess];

       	//Object construction
       	$entity = new swapViewClass();
		$entity->setSwapID($swapID);
		$entity->setItemOfferedID($itemOfferedID);
		$entity->setItemDemandedID($itemDemandedID);
		$entity->setDemandedUserName($demandedUserName);
		$entity->setOfferedUserName($offeredUserName);
		$entity->setStartDate($startDate);
		$entity->setFinishDate($finishDate);
		$entity->setSuccess($success);

		return $entity;
    }

    /*
     * @itemType: findByQuery()
	 * @artist: Irene Blanco 
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

		return swapViewClass::fromResultSetList( $res );
    }

    /*
     * @itemType: findByDemandedUserName()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByDemandedUserName( $userName ) {
		$cons = "select * from `".swapViewClass::$tableName."` where ".swapViewClass::$colNameDemandedUserName." = \"".$userName."\"";

		return swapViewClass::findByQuery( $cons );
    }
    
    /*
     * @itemType: findByOfferedUserName()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByOfferedUserName( $userName ) {
		$cons = "select * from `".swapViewClass::$tableName."` where ".swapViewClass::$colNameOfferedUserName." = \"".$userName."\"";

		return swapViewClass::findByQuery( $cons );
    }
    
      
  /*
     * @itemType: findByStartDate()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByStartDate( $startDate ) {
		$cons = "select * from `".swapViewClass::$tableName."` where ".swapViewClass::$colNameStartDate." = \"".$startDate."\" order by ".swapViewClass::$colNameStartDate." DESC";

		return swapViewClass::findByQuery( $cons );
    }
  
  /*
     * @itemType: findBySuccess()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findBySuccess() {
		$cons = "select * from `".swapViewClass::$tableName."` where ".swapViewClass::$colNameSuccess." = 1 order by ".swapViewClass::$colNameFinishDate." DESC";

		return swapViewClass::findByQuery( $cons );
    }
    
    
    /*
     * @itemType: findAll()
	 * @artist: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".swapViewClass::$tableName."`";
		return swapViewClass::findByQuery( $cons );
    }

    

	/*
     * @itemType: create()
	 * @artist: Irene Blanco
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
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("insert into ".swapViewClass::$tableName."(`swapID`,`itemOfferedID`,`itemDemandedID`,`demandedUserName`,`offeredUserName`,`startDate`,`finishDate`,`success`) values (?,?,?,?,?,?,?,?)" )) {
			$stmt->bind_param("iiissssi",$this->getSwapID(), $this->getItemOfferedID(),$this->getItemDemandedID(), $this->getDemandedUserName(),$this->getOfferedUserName(),  $this->getStartDate() , $this->getFinishDate() , $this->getSuccess());
			//executar consulta
			$stmt->execute();
		}
			
		if ( $conn != null ) $conn->close();
	}

	/*
     * @itemType: delete()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this function deletes a row into the database
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function delete(){
		//Connection with the database
		$conn = new BDSwap_your_music();
		if (mysqli_connect_errno()) {
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
		}
		
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("DELETE `".swapViewClass::$tableName."` where ".swapViewClass::$colNameSwapID." = ?")) {
			$stmt->bind_param("i",$this->getSwapID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @itemType: update()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this function updates a row into the database
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 
    public function update(){
		//Connection with the database
		$conn = new BDSwap_your_music();
		if (mysqli_connect_errno()){
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
		}
		
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("update `".swapViewClass::$tableName."` set ".swapViewClass::$colNameItemOfferedID." = ?,".swapViewClass::$colNameItemDemandedID." = ?,".swapViewClass::$colNameDemandedUserName." = ?,".swapViewClass::$colNameOfferedUserName." = ?,".swapViewClass::$colNameStartDate." = ?,".swapViewClass::$colNameFinishDate." = ?,".swapViewClass::$colNameSuccess." = ? where ".swapViewClass::$colNameSwapID." =?") ) {
			$stmt->bind_param("iissssii", $this->getItemOfferedID(),$this->getItemDemandedID(), $this->getDemandedUserName(),$this->getOfferedUserName(),  $this->getStartDate() , $this->getFinishDate() , $this->getSuccess(), $this->getSwapID());
			//executar consulta
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }    
    
    public function getView(){
		$cons = "SELECT a.swapID, a.offeredItemID, a.demandedItemID, uOffer.userName, uDemand.userName, s.startDate, s.finishDate, s.success, e.itemAsDescribed, e.comunication 
				FROM applications a
				LEFT OUTER JOIN swaps s ON (a.swapID = s.swapID)
				LEFT OUTER JOIN evaluations e ON (a.swapID = e.swapID)
				LEFT OUTER JOIN items iOffered ON (a.offeredItemID = iOffered.itemID)
				LEFT OUTER JOIN items iDemanded ON (a.demandedItemID = iDemanded.itemID)
				LEFT OUTER JOIN users uOffer ON (iOffered.userID = uOffer.userID)
				LEFT OUTER JOIN users uDemand ON (iDemanded.userID = uDemand.userID)";

		return swapViewClass::findByQuery( $cons );
	}
}
?>
