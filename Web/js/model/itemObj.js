function itemObj ()
{
	//Attributes declaration
	this.itemID;
	this.userID;
	this.itemType;
	this.title;
	this.artist;
	this.releaseYear;
	this.genreID;
	this.conditionID;
	this.image;
	this.available;
	this.uploadDate;
	
	
	//Methods declaration
	this.construct = function (itemID,userID,itemType, title, artist, releaseYear, genreID, conditionID, image, available, uploadDate)
	{
		this.setItemID(itemID);
		this.setUserID(userID);
		this.setItemType(itemType);
		this.setTitle(title);
		this.setArtist(artist);
		this.setReleaseYear(releaseYear);
		this.setGenreID(genreID);
		this.setConditionID(conditionID);
		this.setImage(image);
		this.setAvailable(available);
		this.setUploadDate(uploadDate);
	}
	
	//getters and setters
	this.setItemID = function (itemID){this.itemID=itemID;}
	this.setUserID = function (userID){this.userID=userID;}
	this.setItemType = function (itemType){this.itemType=itemType;}
	this.setTitle = function (title){this.title=title;}
	this.setArtist = function (artist){this.artist=artist;}
	this.setReleaseYear = function (releaseYear){this.releaseYear=releaseYear;}
	this.setGenreID = function (genreID){this.genreID=genreID;}
	this.setConditionID = function (conditionID){this.conditionID=conditionID;}
	this.setImage = function (image){this.image=image;}
	this.setAvailable = function (available){this.available=available;}
	this.setUploadDate= function(uploadDate){this.uploadDate=uploadDate;}
	
	this.getItemID = function () {return this.itemID;}
	this.getUserID = function () {return this.userID;}
	this.getItemType = function () {return this.itemType;}
	this.getTitle = function () {return this.title;}
	this.getArtist = function () {return this.artist;}
	this.getReleaseYear = function () {return this.releaseYear;}
	this.getGenreID = function () {return this.genreID;}
	this.getConditionID = function () {return this.conditionID;}
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
	this.arrayToString = function(arrayItemObj){
		var itemString="";
		$.each(arrayItemObj, function(index,item){
			arrayItemObj+="User number "+(index+1)+":"+item.toString()+"\n";
		});
		return itemString;
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
		var itemString="id= "+this.getItemID()+ " userID= "+this.getUserID()+" itemType= "+this.getItemType()+" title= "+this.getTitle()+" artist= "+this.getArtist()+" releaseYear= "+this.getReleaseYear()+" genreID= "+this.getGenreID()+" conditionID= "+this.getConditionID()+" image= "+this.getImage()+" avaliable= "+this.getAvailable()+ " Upload Date= "+this.getUploadDate();
		return itemString;
	}
}
