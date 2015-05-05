function evaluationObj ()
{
	//Attributes declaration
	this.userID;
	this.swapID;
	this.itemID;
	
	//Methods declaration
	this.construct = function (userID,swapID, itemID)
	{
		this.setUserID(userID);
		this.setSwapID(swapID);
		this.setItemID(itemID);
	}
	
	//getters and setters
	this.setUserID = function (userID){this.userID=userID;}
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setItemID = function (itemID){this.itemID=itemID;}

	
	this.getUserID = function () {return this.userID;}
	this.getSwapID = function () {return this.swapID;}
	this.getItemID = function () {return this.itemID;}

	
	/*
	* @swapID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayApplicationObj){
		var applicationString="";
		$.each(arrayApplicationObj, function(index,application){
			arrayApplicationObj+="province number "+(index+1)+":"+application.toString()+"\n";
		});
		return applicationString;
	}
	
	/*
	* @swapID: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var applicationString="userID= "+this.getUserID()+ " swapID= "+this.getSwapID()+ " itemID= "+this.getItemID();
		return applicationString;
	}
}
