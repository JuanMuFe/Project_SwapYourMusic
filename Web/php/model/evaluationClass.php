<?php
/*
 * evaluationClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class evaluationClass {
    private $evaluationID;
    private $itemAsDescribed;
    private $comunication;

    //----------Data base Values---------------------------------------
    private static $tableName = "evaluations";
    private static $colNameEvaluationID = "evaluationID";
    private static $colNameItemAsDescribed = "itemAsDescribed";
    private static $colNameComunication = "comunication";
        
    function __construct() {
    }
    
    public function getEvaluationID() {
        return $this->evaluationID;
    }
    
    public function setEvaluationID($evaluationID) {
        $this->evaluationID = $evaluationID;
    }
    
    public function getItemAsDescribed() {
        return $this->itemAsDescribed;
    }
    
    public function setItemAsDescribed($itemAsDescribed) {
        $this->itemAsDescribed = $itemAsDescribed;
    }
    
     public function getComunication() {
        return $this->comunication;
    }
    
    public function setComunication($comunication) {
        $this->comunication = $comunication;
    }
  
	
    public function getAll() {
	$data = array();
	$data["evaluationID"] = $this->getEvaluationID();
	$data["itemAsDescribed"] = $this->getItemAsDescribed();
	$data["comunication"] = $this->getComunication();

	return $data;
    }

/*
     * @userItemAsDescribed: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $evaluationID ,$itemAsDescribed
	 * @return: none
	 */ 
    public function setAll($evaluationID ,$itemAsDescribed, $comunication)) {
		$this->setEvaluationID($evaluationID);
		$this->setItemAsDescribed($itemAsDescribed);
		$this->setComunication($comunication);
    }
    
    //---Databese management section-----------------------
     /*
     * @userItemAsDescribed: fromResultSetList()
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
		$entity = evaluationClass::fromResultSet( $row );
		
		$entityList[$i]= $entity;
		$i++;
	}
	return $entityList;
    }

    /*
     * @userItemAsDescribed: fromResultSet()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$evaluationID=$res[evaluationClass::$colNameEvaluationID];
		$itemAsDescribed=$res[evaluationClass::$colNameItemAsDescribed];
		$comunication=$res[evaluationClass::$colNameComunication];


       	//Object construction
       	$entity = new evaluationClass();
		$entity->setEvaluationID($evaluationID);
		$entity->setItemAsDescribed($itemAsDescribed);
		$entity->setComunication($comunication);


		return $entity;
    }

    /*
     * @userItemAsDescribed: findByQuery()
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

	return evaluationClass::fromResultSetList( $res );
    }

    /*
     * @userItemAsDescribed: findById()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $evaluationID ) {
	$cons = "select * from `".evaluationClass::$tableName."` where ".evaluationClass::$colNameEvaluationID." = \"".$evaluationID."\"";

	return evaluationClass::findByQuery( $cons );
    }

 
    /*
     * @userItemAsDescribed: findAll()
	 * @author: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".evaluationClass::$tableName."`";
	return evaluationClass::findByQuery( $cons );
    }


	/*
     * @userItemAsDescribed: create()
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
	if ($stmt->prepare("insert into ".evaluationClass::$tableName."(`evaluationID`,`itemAsDescribed`,`comunication`) values (?,?,?)" )) {
		$stmt->bind_param("isi",$this->getEvaluationID(), $this->getItemAsDescribed(),$this->getComunication());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	}

	/*
     * @userItemAsDescribed: delete()
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
		if ($stmt->prepare("DELETE FROM `".evaluationClass::$tableName."` where ".evaluationClass::$colNameEvaluationID." = ?")) {
			$stmt->bind_param("i",$this->getEvaluationID());
			$stmt->execute();
		}
		if ( $conn != null ) $conn->close();
    }


    /*
     * @userItemAsDescribed: update()
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
		if ($stmt->prepare("update `".evaluationClass::$tableName."` set ".evaluationClass::$colNameEvaluationID." = ?,".evaluationClass::$colNameItemAsDescribed." = ?,".evaluationClass::$colNameComunication." = ? where ".evaluationClass::$colNameEvaluationID." =?") ) {
			$stmt->bind_param("isii",$this->getEvaluationID(), $this->getItemAsDescribed(),$this->getComunication(),$this->getEvaluationID() );
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @userItemAsDescribed: toString()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "evaluationClass[evaluationID=" . $this->evaluationID . "][itemAsDescribed=" . $this->itemAsDescribed . "][comunication=" . $this->comunication."]";
		return $toString;

    }
}
?>
