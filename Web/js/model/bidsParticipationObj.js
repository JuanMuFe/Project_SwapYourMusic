function evaluationObj ()
{
	//Attributes declaration
	this.userID;
	this.bidID;
	this.offeredMoney;
	
	//Methods declaration
	this.construct = function (userID,bidID, offeredMoney)
	{
		this.setUserID(userID);
		this.setBidID(bidID);
		this.setOfferedMoney(offeredMoney);
	}
	
	//getters and setters
	this.setUserID = function (userID){this.userID=userID;}
	this.setBidID = function (bidID){this.bidID=bidID;}
	this.setOfferedMoney = function (offeredMoney){this.offeredMoney=offeredMoney;}

	
	this.getUserID = function () {return this.userID;}
	this.getBidID = function () {return this.bidID;}
	this.getOfferedMoney = function () {return this.offeredMoney;}

	
	/*
	* @bidID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arraybidsParticipationObj){
		var bidsParticipationString="";
		$.each(arraybidsParticipationObj, function(index,bidParticipation){
			arraybidsParticipationObj+="province number "+(index+1)+":"+bidParticipation.toString()+"\n";
		});
		return bidsParticipationString;
	}
	
	/*
	* @bidID: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var bidsParticipationString="userID= "+this.getUserID()+ " bidID= "+this.getBidID()+ " offeredMoney= "+this.getOfferedMoney();
		return bidsParticipationString;
	}
}
