<?php
/*
 * userClass.php
 * @author: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class userClass {
    private $userID;
    private $userType;
    private $userName;
    private $password;
    private $email;
    private $registerDate;
    private $unsubscribeDate;
    private $image;
    private $provinceID;

    //----------Data base Values---------------------------------------
    private static $tableName = "users";
    private static $colNameUserID = "userID";
    private static $colNameUserType = "userType";
    private static $colNameUserName = "userName";
    private static $colNamePassword = "password";
    private static $colNameEmail = "email";
    private static $colNameRegisterDate = "registerDate";
    private static $colNameUnsubscribeDate = "unsubscribeDate";
    private static $colNameImage = "image";
    private static $colNameProvinceID = "provinceID";
        
    function __construct() {
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getUserType() {
        return $this->userType;
    }
    
    public function setUserType($userType) {
        $this->userType = $userType;
    }
    
    public function getUserName() {
        return $this->userName;
    }
    
	public function setUserName($userName) {
        $this->userName = $userName;
    }
     
	public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getRegisterDate() {
        return $this->registerDate;
    }
    public function setRegisterDate($registerDate) {
        $this->registerDate = $registerDate;
    }
    
    public function getUnsubscribeDate() {
        return $this->unsubscribeDate;
    }
    public function setUnsubscribeDate($unsubscribeDate) {
        $this->unsubscribeDate = $unsubscribeDate;
    }
    
    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getProvinceID() {
        return $this->provinceID;
    }
    public function setProvinceID($provinceID) {
        $this->provinceID = $provinceID;
    }
    

	
    public function getAll() {
	$data = array();
	$data["userID"] = $this->getUserID();
	$data["userType"] = $this->getUserType();
	$data["userName"] = $this->getUserName();
	$data["password"] = $this->getPassword();
	$data["email"] = $this->getEmail();
	$data["registerDate"] = $this->getRegisterDate();
	$data["unsubscribeDate"] = $this->getUnsubscribeDate();
	$data["image"] = $this->getImage();
	$data["provinceID"] = $this->getProvinceID();

	return $data;
    }
    

/*
     * @userName: setAll()
	 * @author: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userID ,$userType, $userName, $password,$password,$email, $registerDate,$unsubscribeDate,$provinceID
	 * @return: none
	 */ 
    public function setAll($userID ,$userType, $userName,$password,$email, $registerDate,$unsubscribeDate,$image, $provinceID) {
		$this->setUserID($userID);
		$this->setUserType($userType);
		$this->setUserName($userName);
		$this->setPassword($password);
		$this->setEmail($email);
		$this->setUnsubscribeDate($unsubscribeDate);
		$this->setRegisterDate($registerDate);
		$this->setImage($image);
		$this->setProvinceID($provinceID);
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
		$entity = userClass::fromResultSet( $row );
		
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
		$userID=$res[userClass::$colNameUserID];
		$userType=$res[userClass::$colNameUserType];
		$userName = $res[ userClass::$colNameUserName ];
		$password=$res[userClass::$colNamePassword];
		$email=$res[userClass::$colNameEmail];
		$registerDate=$res[userClass::$colNameRegisterDate];
		$unsubscribeDate=$res[userClass::$colNameUnsubscribeDate];
		$image = $res[ userClass::$colNameImage ];
		$provinceID = $res[ userClass::$colNameProvinceID ];

       	//Object construction
       	$entity = new userClass();
		$entity->setUserID($userID);
		$entity->setUserType($userType);
		$entity->setUserName($userName);
		$entity->setPassword($password);
		$entity->setEmail($email);
		$entity->setRegisterDate($registerDate);
		$entity->setUnsubscribeDate($unsubscribeDate);
		$entity->setImage($image);
		$entity->setProvinceID($provinceID);


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

	return userClass::fromResultSetList( $res );
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
    public static function findById( $userID ) {
	$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameUserID." = \"".$userID."\"";

	return userClass::findByQuery( $cons );
    }
    
    

    /*
     * @userName: findClientByProvince()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findClientByProvince( $provinceID ) {
	$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameProvinceID." = \"".$provinceID."\"";

	return userClass::findByQuery( $cons );
    }
     /*
     * @userName: findClientUsers()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findClientUsers() {
	$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameUserType." = 1";

	return userClass::findByQuery( $cons );
    }
    
    /*
     * @userName: findByUserName()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByUserName( $userName ) {
	$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameUserName." = \"".$userName."\"";

	return userClass::findByQuery( $cons );
    }
  
  /*
     * @userName: findByEmail()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByEmail( $email ) {
	$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameEmail." = \"".$email."\"";

	return userClass::findByQuery( $cons );
    }
  

    /**
	 * findlikeUserName()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: It runs a query and returns an object array
	 * @date: 27/03/2015
	 * @param userName
	 * @return object with the query results
    */
    public static function findClientLikeUserName( $likeUserName ) {
		$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameUserName." like '%".$likeUserName."%' and ".userClass::$colNameUserType." = 1";
		return userClass::findByQuery( $cons );
    }
    
    /*
     * @name: findByUserNameAndPass()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: $name, $password 
	 * @return: object with the query results
	 */ 
    public static function findByUserNameAndPass($userName, $password ) {
		$cons = "select * from `".userClass::$tableName."` where ".userClass::$colNameUserName." = \"".$userName."\" and ".userClass::$colNamePassword." = \"".md5($password)."\"";
		return userClass::findByQuery( $cons );
    }


 
    /*
     * @userName: findAll()
	 * @author: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAll( ) {
    	$cons = "select * from `".userClass::$tableName."`";
	return userClass::findByQuery( $cons );
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
	if ($stmt->prepare("insert into ".userClass::$tableName."(`userID`,`userType`,`userName`,`password`,`email`,`registerDate`,`unsubscribeDate`,`image`,`provinceID`) values (?,?,?,?,?,?,?,?,?)" )) {
		$stmt->bind_param("iissssssi",$this->getUserID(), $this->getUserType(),$this->getUserName(), md5($this->getPassword()) , $this->getEmail() , $this->getRegisterDate() , $this->getUnsubscribeDate() ,$this->getImage(),$this->getProvinceID());
		//executar consulta
		$stmt->execute();
	    }
	    
	    if ( $conn != null ) $conn->close();
	     return $this->getUserID();
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
		if ($stmt->prepare("UPDATE `".userClass::$tableName."` SET unsubscribeDate=? where ".userClass::$colNameUserID." = ?")) {
			$stmt->bind_param("si",$this->getUnsubscribeDate(),$this->getUserID());
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
		if ($stmt->prepare("update `".userClass::$tableName."` set ".userClass::$colNameUserID." = ?,".userClass::$colNameUserType." = ?,".userClass::$colNameUserName." = ?,".userClass::$colNamePassword." = ?,".userClass::$colNameEmail." = ?,".userClass::$colNameRegisterDate." = ?,".userClass::$colNameUnsubscribeDate." = ?, ".userClass::$colNameImage." = ?,".userClass::$colNameProvinceID." = ? where ".userClass::$colNameUserID." =?") ) {
			$stmt->bind_param("iissssssii",$this->getUserID(), $this->getUserType(),$this->getUserName(), $this->getPassword() , $this->getEmail() , $this->getRegisterDate() , $this->getUnsubscribeDate() ,$this->getImage(),$this->getProvinceID(),$this->getUserID());
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
        $toString = "userClass[userID=" . $this->userID . "][userType=" . $this->userType . "][userName=" . $this->userName . "][password=" . $this->password . "][email=" . $this->email . "][registerDate=" . $this->registerDate . "][unsubscribeDate=" . $this->unsubscribeDate . "][image=" . $this->image."][provinceID=" . $this->provinceID . "]";
		return $toString;

    }
}
?>
