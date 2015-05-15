<?php
/*
 * bidViewClass.php
 * @artist: Irene Blanco
 * @version: 1.0
 * @description: php class of the object
 * @date: 27/03/2015
 */
require_once "BDSwap_your_music.php";

class bidViewClass {
    private $bidID;
    private $userName;
    private $userID;
    private $startPrice;
    private $startDate;
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
    private static $colNameUserName = "userName";
    private static $colNameUserID = "userID";
    private static $colNameBidID = "bidID";
    private static $colNameStartPrice = "startPrice";
    private static $colNameActualPrice = "actualPrice";
    private static $colNameStartDate = "startDate";
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
    
    public function getUserID() {
        return $this->userID;
    }
    
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function getBidID() {
        return $this->bidID;
    }
    
    public function setBidID($bidID) {
        $this->bidID = $bidID;
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
    
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    
    public function getStartDate() {
        return $this->startDate;
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
		$data["bidID"] = $this->getBidID();
		$data["userID"] = $this->getUserID();
		$data["startDate"] = $this->getStartDate();
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
     * @name: setAll()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: this functions sets all the object params
	 * @params: $userName ,$startPrice, $itemType, $title,$title,$artist, $releaseYear,$duration,$image
	 * @return: none
	 */ 
	 
    public function setAll($userID, $bidID, $userName, $startPrice, $actualPrice, $duration, $startDate, $finishDate, $itemType, $title, $artist, $releaseYear, $image, $available, $uploadDate){
		$this->setUserID($userID);
		$this->setBidID($bidID);
		$this->setUserName($userName);
		$this->setStartPrice($startPrice);
		$this->setStartPrice($startDate);
		$this->setActualPrice($actualPrice);
		$this->setItemType($itemType);
		$this->setTitle(utf8_decode($title));
		$this->setArtist(utf8_decode($artist));
		$this->setDuration($duration);
		$this->setReleaseYear($releaseYear);
		$this->setFinishDate($finishDate);
		$this->setImage($image);
		$this->setAvailable($available);
		$this->setUploadDate($uploadDate);
    }
    
    //---Databese management section-----------------------
     /*
     * @name: fromResultSetList()
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
			$entity = bidViewClass::fromResultSet( $row );
			
			$entityList[$i]= $entity;
			$i++;
		}
		return $entityList;
    }

    /*
     * @name: fromResultSet()
	 * @artist: Irene Blanco
	 * @version: 1.0
	 * @description: the query result is transformed into an object
     * @date: 27/03/2015
	 * @params: res ResultSet to obtain the data
	 * @return: object
	 */ 
    private static function fromResultSet( $res ) {
		//We get all the values form the query
		$bidID=$res[bidViewClass::$colNameBidID];
		$userID=$res[bidViewClass::$colNameUserID];
		$userName=$res[bidViewClass::$colNameUserName];
		$startPrice=$res[bidViewClass::$colNameStartPrice];
		$startDate=$res[bidViewClass::$colNameStartDate];
		$actualPrice=$res[bidViewClass::$colNameActualPrice];
		$itemType = $res[ bidViewClass::$colNameItemType ];
		$title=$res[bidViewClass::$colNameTitle];
		$artist=$res[bidViewClass::$colNameArtist];
		$releaseYear=$res[bidViewClass::$colNameReleaseYear];
		$duration=$res[bidViewClass::$colNameDuration];
		$finishDate = $res[ bidViewClass::$colNameFinishDate ];
		$image = $res[ bidViewClass::$colNameImage ];
		$available = $res[ bidViewClass::$colNameAvailable ];
		$uploadDate= $res [ bidViewClass::$colNameUploadDate ];

       	//Object construction
       	$entity = new bidViewClass();
		$entity->setUserID($userID);
		$entity->setBidID($bidID);
		$entity->setUserName($userName);
		$entity->setStartPrice($startPrice);
		$entity->setStartDate($startDate);
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
     * @name: findByQuery()
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

		return bidViewClass::fromResultSetList( $res );
    }

   /*
     * @name: getView()
	 * @artist: Irene Blanco 
	 * @version: 1.0
	 * @description: this function runs a query and returns an object array
     * @date: 27/03/2015
	 * @params: id
	 * @return: object with the query results
	 */ 
    public static function getView( ) {
		$cons = "SELECT i.userID, u.userName, b.startPrice, b.bidID, b.actualPrice, b.startDate, b.duration, b.finishDate, i.itemType, i.title, i.artist, i.releaseYear, i.uploadDate, i.available, i.image 
				FROM bids b
				LEFT OUTER JOIN items i  ON (b.itemID = i.itemID)
				LEFT OUTER JOIN users u ON (i.userID = u.userID)";

		return bidViewClass::findByQuery( $cons );
    }
}
?>
