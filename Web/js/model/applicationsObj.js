function applicationsObj ()
{
	//Attributes declaration
	this.swapID;
	this.offeredItemID;
	this.demandedItemID;
	
	//Methods declaration
	this.construct = function (swapID,offeredItemID, demandedItemID)
	{
		this.setSwapID(swapID);
		this.setOfferedItemID(offeredItemID);
		this.setDemandedItemIDdemandedItemID);
	}
	
	//getters and setters
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setOfferedItemID = function (offeredItemID){this.offeredItemID=offeredItemID;}
	this.setDemandedItemID = function (demandedItemID){this.demandedItemID=demandedItemID;}

	
	this.getSwapID = function () {return this.swapID;}
	this.getOfferedItemID = function () {return this.offeredItemID;}
	this.getDemandedItemID = function () {return this.demandedItemID;}

	
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
		var applicationString="swapID= "+this.getSwapID()+ " offeredItemID= "+this.getOfferedItemID()+" demandedItemID="+this.getDemandedItemID();
		return applicationString;
	}
}
