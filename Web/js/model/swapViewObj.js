function swapViewObj(){
	
	//Attributes declaration
	this.swapID;
	this.itemOfferedID;
	this.itemDemandedID;
	this.demandedUserName;
	this.offeredUserName;
	this.startDate;
	this.finishDate;
	this.success;
	
	//Methods declaration
	this.construct = function (swapID, itemOfferedID, itemDemandedID, demandedUserName, offeredUserName, startDate, finishDate, 
								success){
		this.setSwapID(swapID);
		this.setItemOfferedID(itemOfferedID);
		this.setItemDemandedID(itemDemandedID);
		this.setDemandedUserName(demandedUserName);
		this.setOfferedUserName(offeredUserName);
		this.setStartDate(startDate);
		this.setFinishDate(finishDate);
		this.setSuccess(success);
	}
	
	//getters and setters
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setItemOfferedID = function (itemOfferedID){this.itemOfferedID=itemOfferedID;}
	this.setItemDemandedID = function (itemDemandedID){this.itemDemandedID=itemDemandedID;}
	this.setDemandedUserName = function (demandedUserName){this.demandedUserName=demandedUserName;}
	this.setOfferedUserName = function (offeredUserName){this.offeredUserName=offeredUserName;}
	this.setStartDate = function (startDate){this.startDate=startDate;}
	this.setFinishDate = function (finishDate){this.finishDate=finishDate;}
	this.setSuccess = function (success){this.success=success;}
		
	this.getSwapID = function () {return this.swapID;}
	this.getItemOfferedID = function () {return this.itemOfferedID;}
	this.getItemDemandedID = function () {return this.itemDemandedID;}
	this.getDemandedUserName = function () {return this.demandedUserName;}
	this.getOfferedUserName = function () {return this.offeredUserName;}
	this.getStartDate = function () {return this.startDate;}
	this.getFinishDate = function () {return this.finishDate;}
	this.getSuccess = function () {return this.success;}
	
	/*
	* @name: arrayToString()
	* @artist: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/
	this.arrayToString = function(arraySwapView){
		var swapViewString="";
		$.each(arraySwapView, function(index,item){
			swapViewString+="User number "+(index+1)+":"+item.toString()+"\n";
		});
		return swapViewString;
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
		var swapViewString="swapID "+this.getSwapID()+"itemOfferedID "+this.getItemOfferedID()+"itemDemandedID "+this.getItemDemandedID()+
		 " demandedUserName= "+this.getDemandedUserName()+" offeredUserName= "+this.getOfferedUserName()+" startDate= "+this.getStartDate()+
		 " finishDate= "+this.getFinishDate()+" success= "+this.getSuccess();
		return swapViewString;
	}
}
