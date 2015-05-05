<?php
/*
 * itemClass.php
 * @artist: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class itemClass {
    private $itemID;
    private $userID;
    private $itemType;
    private $title;
    private $artist;
    private $releaseYear;
    private $genreID;
    private $conditionID;
    private $image;
    private $avaliable;

    //----------Data base Values---------------------------------------
    private static $tableName = "items";
    private static $colNameItemID = "itemID";
    private static $colNameUserID = "userID";
    private static $colNameItemType = "itemType";
    private static $colNameTitle = "title";
    private static $colNameArtist = "artist";
    private static $colNameReleaseYear = "releaseYear";
    private static $colNameGenreID = "genreID";
    private static $colNameConditionID = "conditionID";
    private static $colNameImage = "image";
    private static $colNameAvaliable = "avaliable";
        
    function __construct() {
    }
    
    public function getItemID() {
        return $this->itemID;
    }
    
    public function setItemID($itemID) {
        $this->itemID = $itemID;
    }
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getItemType() {
        return $this->itemType;
    }
    
	public function setItemType($itemType) {
        $this->itemType = $itemType;
    }
     
	public function getTitle() {
        return $this->title;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getArtist() {
        return $this->artist;
    }
    
    public function setArtist($artist) {
        $this->artist = $artist;
    }
    
    public function getReleaseYear() {
        return $this->releaseYear;
    }
    public function setReleaseYear($releaseYear) {
        $this->releaseYear = $releaseYear;
    }
    
    public function getGenreID() {
        return $this->genreID;
    }
    public function setGenreID($genreID) {
        $this->genreID = $genreID;
    }
    
    public function getConditionID() {
        return $this->conditionID;
    }
    public function setConditionID($conditionID) {
        $this->conditionID = $conditionID;
    }
    
    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getAvaliable() {
        return $this->avaliable;
    }
    public function setAvaliable($avaliable) {
        $this->avaliable = $avaliable;
    }
    

	
    public function getAll() {
	$data = array();
	$data["itemID"] = $this->getItemID();
	$data["userID"] = $this->getUserID();
	$data["itemType"] = $this->getItemType();
	$data["title"] = $this->getTitle();
	$data["artist"] = $this->getArtist();
	$data["releaseYear"] = $this->getReleaseYear();
	$data["genreID"] = $this->getgenreID();
	$data["conditionID"] = $this->getConditionID();
	$data["image"] = $this->getImage();
	$data["avaliable"] = $this->getAvaliable();

	return $data;
    }

/*
     * @itemType: setAll()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $itemID ,$userID, $itemType, $title,$title,$artist, $releaseYear,$genreID,$image
	 * @return: none
	 */ 
    public function setAll($itemID ,$userID, $itemType,$title,$artist, $releaseYear,$genreID,$conditionID, $image, $avaliable) {
		$this->setItemID($itemID);
		$this->setUserID($userID);
		$this->setItemType($itemType);
		$this->setTitle($title);
		$this->setArtist($artist);
		$this->setgenreID($genreID);
		$this->setReleaseYear($releaseYear);
		$this->setConditionID($conditionID);
		$this->setImage($image);
		$this->setAvaliable($avaliable);
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
		$entity = itemClass::fromResultSet( $row );
		
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
		$itemID=$res[itemClass::$colNameItemID];
		$userID=$res[itemClass::$colNameUserID];
		$itemType = $res[ itemClass::$colNameItemType ];
		$title=$res[itemClass::$colNameTitle];
		$artist=$res[itemClass::$colNameArtist];
		$releaseYear=$res[itemClass::$colNameReleaseYear];
		$genreID=$res[itemClass::$colNameGenreID];
		$conditionID = $res[ itemClass::$colNameConditionID ];
		$image = $res[ itemClass::$colNameImage ];
		$avaliable = $res[ itemClass::$colNameAvaliable ];

       	//Object construction
       	$entity = new itemClass();
		$entity->setItemID($itemID);
		$entity->setUserID($userID);
		$entity->setItemType($itemType);
		$entity->setTitle($title);
		$entity->setArtist($artist);
		$entity->setReleaseYear($releaseYear);
		$entity->setgenreID($genreID);
		$entity->setconditionID($conditionID);
		$entity->setImage($image);
		$entity->setAvaliable($avaliable);


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

	return itemClass::fromResultSetList( $res );
    }

    /*
     * @itemType: findById()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findById( $itemID ) {
	$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameItemID." = \"".$itemID."\"";

	return itemClass::findByQuery( $cons );
    }
  
  
  /*
     * @itemType: findByGenre()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByGenre( $genreID ) {
	$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameGenreID." = \"".$genreID."\"";

	return itemClass::findByQuery( $cons );
    }
    
    /*
     * @itemType: findByReleaseYear()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByReleaseYear( $releaseYear ) {
	$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameReleaseYear." = \"".$releaseYear."\"";

	return itemClass::findByQuery( $cons );
    }
    

    /**
	 * findlikeArtist()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: It runs a query and returns an object array
	 * @date: 27/03/2015
	 * @param itemType
	 * @return object with the query results
    */
    public static function findlikeArtist( $artist ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameArtist." like \"%".$artist."%\"";
		return itemClass::findByQuery( $cons );
    }


	/**
	 * findlikeTitle()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: It runs a query and returns an object array
	 * @date: 27/03/2015
	 * @param itemType
	 * @return object with the query results
    */
    public static function findlikeTitle( $title ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameTitle." like \"%".$title."%\"";
		return itemClass::findByQuery( $cons );
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
    	$cons = "select * from `".itemClass::$tableName."`";
	return itemClass::findByQuery( $cons );
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
	//return $this->toString();
	//Preparing the sentence
	$stmt = $conn->stmt_init();
	if ($stmt->prepare("insert into ".itemClass::$tableName."(`itemID`,`userID`,`itemType`,`title`,`artist`,`releaseYear`,`genreID`,`conditionID`,`image`,`avaliable`) values (?,?,?,?,?,?,?,?,?,?)" )) {
		$stmt->bind_param("iiissiiisi",$this->getItemID(), $this->getUserID(),$this->getItemType(), $this->getTitle() , $this->getArtist() , $this->getReleaseYear() , $this->getGenreID() ,$this->getConditionID(),$this->getImage(),$this->getAvaliable());
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
    public function delete() {
		//Connection with the database
		$conn = new BDSwap_your_music();
		if (mysqli_connect_errno()) {
    		printf("Connection with the database has failed, error: %s\n", mysqli_connect_error());
    		exit();
		}
		
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("UPDATE `".itemClass::$tableName."` SET avaliable=0 where ".itemClass::$colNameItemID." = ?")) {
			$stmt->bind_param("i",$this->getItemID());
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
		if ($stmt->prepare("update `".itemClass::$tableName."` set ".itemClass::$colNameItemID." = ?,".itemClass::$colNameUserID." = ?,".itemClass::$colNameItemType." = ?,".itemClass::$colNameTitle." = ?,".itemClass::$colNameArtist." = ?,".itemClass::$colNameReleaseYear." = ?,".itemClass::$colNameGenreID." = ?, ".itemClass::$colNameConditionID." = ?,".itemClass::$colNameImage." = ?,".itemClass::$colNameAvaliable." = ? where ".itemClass::$colNameItemID." =?") ) {
			$stmt->bind_param("iiissiiisii",$this->getItemID(), $this->getUserID(),$this->getItemType(), $this->getTitle() , $this->getArtist() , $this->getReleaseYear() , $this->getGenreID() ,$this->getConditionID(),$this->getImage(),$this->getAvaliable(),$this->getItemID());
			//executar consulta
			$stmt->execute();;
		}
		if ( $conn != null ) $conn->close();

    }
    
    
    /*
     * @itemType: toString()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this function converts to string the object
     * @date: 27/03/2015
	 * @params: none
	 * @return: none
	 */ 	
    public function toString() {
        $toString = "itemClass[itemID=" . $this->itemID . "][userID=" . $this->userID . "][itemType=" . $this->itemType . "][title=" . $this->title . "][artist=" . $this->artist . "][releaseYear=" . $this->releaseYear . "][genreID=" . $this->genreID . "][conditionID=" . $this->conditionID."][image=" . $this->image . "][avaliable=" . $this->avaliable."]";
		return $toString;

    }
}
?>
