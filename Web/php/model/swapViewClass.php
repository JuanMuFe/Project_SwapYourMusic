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
    private $userName;
    private $startPrice;
    private $actualPrice;
    private $itemType;
    private $title;
    private $artist;
    private $releaseYear;
    private $duration;
    private $finishDate;
    private $image;
    private $available;
    private $uploadDate;

    //----------Data base Values---------------------------------------
    private static $tableName = "items";
    private static $colNameUserName = "userName";
    private static $colNameStartPrice = "startPrice";
    private static $colNameActualPrice = "actualPrice";
    private static $colNameItemType = "itemType";
    private static $colNameTitle = "title";
    private static $colNameArtist = "artist";
    private static $colNameReleaseYear = "releaseYear";
    private static $colNameDuration = "duration";
    private static $colNameFinishDate = "finishDate";
    private static $colNameImage = "image";
    private static $colNameAvailable = "available";
    private static $colNameUploadDate = "uploadDate";
    
        
    function __construct() {
    }
    
    public function getUserName() {
        return $this->userName;
    }
    
    public function setUserName($userName) {
        $this->userName = $userName;
    }
    
    public function getStartPrice() {
        return $this->startPrice;
    }
    
    public function setStartPrice($startPrice) {
        $this->startPrice = $startPrice;
    }
    
    public function getActualPrice() {
        return $this->actualPrice;
    }
    
    public function setActualPrice($actualPrice) {
        $this->actualPrice = $actualPrice;
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
    
    public function getDuration() {
        return $this->duration;
    }
    public function setDuration($duration) {
        $this->duration = $duration;
    }
    
    public function getFinishDate() {
        return $this->finishDate;
    }
    public function setFinishDate($finishDate) {
        $this->finishDate = $finishDate;
    }
    
    public function getImage() {
        return $this->image;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getAvailable() {
        return $this->available;
    }
    public function setAvailable($available) {
        $this->available = $available;
    }
    
	public function getUploadDate() {
        return $this->uploadDate;
    }
    
    public function setUploadDate($uploadDate) {
        $this->uploadDate = $uploadDate;
    }
	
    public function getAll() {
		$data = array();
		$data["userName"] = $this->getUserName();
		$data["startPrice"] = $this->getStartPrice();
		$data["actualPrice"] = $this->getActualPrice();
		$data["itemType"] = $this->getItemType(); 
		$data["title"] = utf8_encode($this->getTitle());
		$data["artist"] = utf8_encode($this->getArtist());
		$data["releaseYear"] = $this->getReleaseYear();
		$data["duration"] = $this->getDuration();
		$data["finishDate"] = $this->getFinishDate();
		$data["image"] = utf8_encode($this->getImage());
		$data["available"] = $this->getAvailable();
		$data["uploadDate"] = $this->getUploadDate();
		
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
    public function setAll($userName ,$startPrice, $actualPrice, $itemType,$title,$artist, $releaseYear,$duration,$finishDate, $image, $available, $uploadDate){
		$this->setUserName($userName);
		$this->setStartPrice($startPrice);
		$this->setActualPrice($actualPrice);
		$this->setItemType($itemType);
		$this->setTitle(utf8_decode($title));
		$this->setArtist(utf8_decode($artist));
		$this->setduration($duration);
		$this->setReleaseYear($releaseYear);
		$this->setFinishDate($finishDate);
		$this->setImage($image);
		$this->setAvailable($available);
		$this->setUploadDate($uploadDate);
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
		$userName=$res[itemClass::$colNameUserName];
		$startPrice=$res[itemClass::$colNameStartPrice];
		$actualPrice=$res[itemClass::$colNameActualPrice];
		$itemType = $res[ itemClass::$colNameItemType ];
		$title=$res[itemClass::$colNameTitle];
		$artist=$res[itemClass::$colNameArtist];
		$releaseYear=$res[itemClass::$colNameReleaseYear];
		$duration=$res[itemClass::$colNameDuration];
		$finishDate = $res[ itemClass::$colNameFinishDate ];
		$image = $res[ itemClass::$colNameImage ];
		$available = $res[ itemClass::$colNameAvailable ];
		$uploadDate= $res [ itemClass::$colNameUploadDate ];

       	//Object construction
       	$entity = new itemClass();
		$entity->setUserName($userName);
		$entity->setStartPrice($startPrice);
		$entity->setActualPrice($actualPrice);
		$entity->setItemType($itemType);
		$entity->setTitle($title);
		$entity->setArtist($artist);
		$entity->setReleaseYear($releaseYear);
		$entity->setDuration($duration);
		$entity->setFinishDate($finishDate);
		$entity->setImage($image);
		$entity->setAvailable($available);
		$entity->setUploadDate($uploadDate);

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
    public static function findById( $userName ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameUserName." = \"".$userName."\"";

		return itemClass::findByQuery( $cons );
    }
    
    /*
     * @itemType: findByUserId()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: userId
	 * @return: object with the query results
	 */ 
    public static function findByUserId( $startPrice ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameStartPrice." = \"".$startPrice."\"";

		return itemClass::findByQuery( $cons );
    }    
  
  /*
     * @itemType: findByItemType()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByItemType( $itemType ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameItemType." = \"".$itemType."\" order by ".itemClass::$colNameUploadDate." DESC";

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
    public static function findByGenre( $duration ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameDuration." = \"".$duration."\" order by ".itemClass::$colNameUploadDate." DESC";

		return itemClass::findByQuery( $cons );
    }
    
    /*
     * @itemType: findByItemtypeAndGenre()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByItemtypeAndGenre( $itemType, $duration ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameDuration." = \"".$duration."\" AND ".itemClass::$colNameItemType."= \"".$itemType."\" order by ".itemClass::$colNameUploadDate." DESC";

		return itemClass::findByQuery( $cons );
    }
    
    /*
     * @itemType: findByItemTypeAndArtist()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function findByItemTypeAndArtist( $itemType, $artist ) {
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameItemType." = \"".$itemType."\" AND ".itemClass::$colNameArtist." like \"%".$artist."%\" order by ".itemClass::$colNameUploadDate." DESC";

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
		$cons = "select * from `".itemClass::$tableName."` where ".itemClass::$colNameArtist." like \"%".$artist."%\" order by ".itemClass::$colNameUploadDate." DESC";
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
     * @itemType: findAll()
	 * @artist: Irene Blanco & Carlos García
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: objects collection
	 */ 
    public static function findAllWithLimit( $limitNumber ) {
    	$cons = "select * from `".itemClass::$tableName."` order by ".itemClass::$colNameUploadDate." DESC limit ".$limitNumber;
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
		//Preparing the sentence
		$stmt = $conn->stmt_init();
		if ($stmt->prepare("insert into ".itemClass::$tableName."(`userName`,`startPrice`,`actualPrice`,`itemType`,`title`,`artist`,`releaseYear`,`duration`,`finishDate`,`image`,`available`,`uploadDate`) values (?,?,?,?,?,?,?,?,?,?,?,?)" )) {
			$stmt->bind_param("iiisssiiisis",$this->getUserName(), $this->getStartPrice(),$this->getActualPrice(), $this->getItemType(),$this->getTitle(),  $this->getArtist() , $this->getReleaseYear() , $this->getDuration() ,$this->getFinishDate(),$this->getImage(),$this->getAvailable(), $this->getUploadDate());
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
		if ($stmt->prepare("UPDATE `".itemClass::$tableName."` SET available=0 where ".itemClass::$colNameUserName." = ?")) {
			$stmt->bind_param("i",$this->getUserName());
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
		if ($stmt->prepare("update `".itemClass::$tableName."` set ".itemClass::$colNameUserName." = ?,".itemClass::$colNameStartPrice." = ?,".itemClass::$colNameActualPrice." = ?,".itemClass::$colNameItemType." = ?,".itemClass::$colNameTitle." = ?,".itemClass::$colNameArtist." = ?,".itemClass::$colNameReleaseYear." = ?,".itemClass::$colNameDuration." = ?, ".itemClass::$colNameFinishDate." = ?,".itemClass::$colNameImage." = ?,".itemClass::$colNameAvailable." = ?,".itemClass::$colNameUploadDate." = ? where ".itemClass::$colNameUserName." =?") ) {
			$stmt->bind_param("iiisssiiisisi",$this->getUserName(), $this->getStartPrice(), $this->getActualPrice(),$this->getItemType(), $this->getTitle() , $this->getArtist() , $this->getReleaseYear() , $this->getDuration() ,$this->getFinishDate(), $this->getImage(),$this->getAvailable(),$this->getUploadDate(),$this->getUserName());
			//executar consulta
			$stmt->execute();
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
        $toString = "itemClass[userName=" . $this->userName . "][startPrice=" . $this->startPrice . "][itemType=" . $this->itemType . "][title=" . $this->title . "][artist=" . $this->artist . "][releaseYear=" . $this->releaseYear . "][duration=" . $this->duration . "][finishDate=" . $this->finishDate."][image=" . $this->image . "][available=" . $this->available."][upload date=".$this->uploadDate."]";
		return $toString;

    }
}
?>
