function bidObj ()
{
	//Attributes declaration
	this.bidID;
	this.startPrice;
	this.duration;
	this.startDate;
	this.finishDate;
	
	//Methods declaration
	this.construct = function (bidID,startPrice, duration, startDate, finishDate)
	{
		this.setBidID(bidID);
		this.setStartPrice(startPrice);
		this.setDuration(duration);
		this.setStartDate(startDate);
		this.setFinishDate(finishDate);
	}
	
	//getters and setters
	this.setBidID = function (bidID){this.bidID=bidID;}
	this.setStartPrice = function (startPrice){this.startPrice=startPrice;}
	this.setDuration = function (duration){this.duration=duration;}
	this.setStartDate = function (startDate){this.startDate=startDate;}
	this.setFinishDate = function (finishDate){this.finishDate=finishDate;}
	
	this.getBidID = function () {return this.bidID;}
	this.getStartPrice = function () {return this.startPrice;}
	this.getDuration = function () {return this.duration;}
	this.getStartDate = function () {return this.startDate;}
	this.getFinishDate = function () {return this.finishDate;}

	
	/*
	* @startPrice: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @duration: this function formats in a friendly way the objects of an array
	* @startDate: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayBidObj){
		var bidString="";
		$.each(arrayBidObj, function(index,bid){
			arrayBidObj+="event number "+(index+1)+":"+bid.toString()+"\n";
		});
		return bidString;
	}
	
	/*
	* @startPrice: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @duration: this function formats the object data into a string
	* @startDate: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var bidString="bidID= "+this.getBidID()+ " startPrice= "+this.getStartPrice()+ " duration= "+this.getDuration()+ " startDate= "+this.getStartDate()+ " finishDate= "+this.getFinishDate();
		return bidString;
	}
}
