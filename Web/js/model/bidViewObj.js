function bidViewObj ()
{
	//Attributes declaration
	this.userName;
	this.userID;
	this.bidID;
	this.startPrice;
	this.actualPrice;
	this.itemType;
	this.title;
	this.artist;
	this.releaseYear;
	this.duration;
	this.finishDate;
	this.image;
	this.available;
	this.uploadDate;
	

	
	//Methods declaration
	this.construct = function (userID, bidID, userName, startPrice, actualPrice, duration, startDate, finishDate, itemType, title, artist, releaseYear, image, available, uploadDate)
	{
		this.setUserName(userName);
		this.setUserID(userID);
		this.setBidID(bidID);
		this.setStartPrice(startPrice);
		this.setStartDate(startDate);
		this.setActualPrice(actualPrice);
		this.setItemType(itemType);
		this.setTitle(title);
		this.setArtist(artist);
		this.setReleaseYear(releaseYear);
		this.setDuration(duration);
		this.setFinishDate(finishDate);
		this.setImage(image);
		this.setAvailable(available);
		this.setUploadDate(uploadDate);
	}
	
	//getters and setters
	this.setUserID = function (userID){this.userID=userID;}
	this.setBidID = function (bidID){this.bidID=bidID;}
	this.setUserName = function (userName){this.userName=userName;}
	this.setStartPrice = function (startPrice){this.startPrice=startPrice;}
	this.setStartDate = function (startDate){this.startDate=startDate;}
	this.setActualPrice = function (actualPrice){this.actualPrice=actualPrice;}
	this.setItemType = function (itemType){this.itemType=itemType;}
	this.setTitle = function (title){this.title=title;}
	this.setArtist = function (artist){this.artist=artist;}
	this.setReleaseYear = function (releaseYear){this.releaseYear=releaseYear;}
	this.setDuration = function (duration){this.duration=duration;}
	this.setFinishDate = function (finishDate){this.finishDate=finishDate;}
	this.setImage = function (image){this.image=image;}
	this.setAvailable = function (available){this.available=available;}
	this.setUploadDate= function(uploadDate){this.uploadDate=uploadDate;}
	
	this.getUserID = function () {return this.userID;}
	this.getBidID = function () {return this.bidID ;}
	this.getUserName = function () {return this.userName;}
	this.getStartPrice = function () {return this.startPrice;}
	this.getStartDate = function () {return this.startDate;}
	this.getActualPrice = function () {return this.actualPrice;}
	this.getItemType = function () {return this.itemType;}
	this.getTitle = function () {return this.title;}
	this.getArtist = function () {return this.artist;}
	this.getReleaseYear = function () {return this.releaseYear;}
	this.getDuration = function () {return this.duration;}
	this.getFinishDate = function () {return this.finishDate;}
	this.getImage = function () {return this.image;}
	this.getAvailable = function () {return this.available;}
	this.getUploadDate= function () {return this.uploadDate;}
	
	/*
	* @name: arrayToString()
	* @artist: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/
	this.arrayToString = function(arrayBidView){
		var bidViewString="";
		$.each(arrayBidView, function(index,item){
			arrayBidView+="User number "+(index+1)+":"+item.toString()+"\n";
		});
		return bidViewString;
	}
	
	/*
	* @name: toString()
	* @artist: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var bidViewString="bidID "+this.getBidID()+"userID "+this.getUserID()+"userName "+this.getUserName()+ " startPrice= "+this.getStartPrice()+" itemType= "+this.getItemType()+" title= "+this.getTitle()+" artist= "+this.getArtist()+" releaseYear= "+this.getReleaseYear()+" duration= "+this.getDuration()+" finishDate= "+this.getFinishDate()+" image= "+this.getImage()+" avaliable= "+this.getAvailable()+ " Upload Date= "+this.getUploadDate();
		return bidViewString;
	}
}
