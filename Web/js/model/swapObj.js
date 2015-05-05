function swapObj ()
{
	//Attributes declaration
	this.swapID;
	this.startDate;
	this.finishDate;
	this.success;
		
	//Methods declaration
	this.construct = function (swapID,startDate, finishDate, success)
	{
		this.setSwapID(swapID);
		this.setStartDate(startDate);
		this.setFinishDate(finishDate);
		this.setSuccess(success);
	}
	
	//getters and setters
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setStartDate = function (startDate){this.startDate=startDate;}
	this.setFinishDate = function (finishDate){this.finishDate=finishDate;}
	this.setSuccess = function (success){this.success=success;}
	
	this.getSwapID = function () {return this.swapID;}
	this.getStartDate = function () {return this.startDate;}
	this.getFinishDate = function () {return this.finishDate;}
	this.getSuccess = function () {return this.success;}
	
	/*
	* @startDate: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @finishDate: this function formats in a friendly way the objects of an array
	* @success: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arraySwapObj){
		var swapString="";
		$.each(arraySwapObj, function(index,swap){
			arraySwapObj+="swap number "+(index+1)+":"+swap.toString()+"\n";
		});
		return swapString;
	}
	
	/*
	* @startDate: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @finishDate: this function formats the object data into a string
	* @success: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var swapString="swapID= "+this.getSwapID()+ " startDate= "+this.getStartDate()+ " finishDate= "+this.getFinishDate()+ " success= "+this.getSuccess();
		return swapString;
	}
}
