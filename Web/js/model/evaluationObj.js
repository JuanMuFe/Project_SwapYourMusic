function evaluationObj ()
{
	//Attributes declaration
	this.evaluationID;
	this.swapID;
	this.itemAsDescribed;
	this.comunication;
	
	//Methods declaration
	this.construct = function (evaluationID, swapID, itemAsDescribed, comunication)
	{
		this.setEvaluationID(evaluationID);
		this.setSwapID(swapID);
		this.setItemAsDescribed(itemAsDescribed);
		this.setComunication(comunication);
	}
	
	//getters and setters
	this.setEvaluationID = function (evaluationID){this.evaluationID=evaluationID;}
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setItemAsDescribed = function (itemAsDescribed){this.itemAsDescribed=itemAsDescribed;}
	this.setComunication = function (comunication){this.comunication=comunication;}

	
	this.getEvaluationID = function () {return this.evaluationID;}
	this.getSwapID = function () {return this.swapID;}
	this.getItemAsDescribed = function () {return this.itemAsDescribed;}
	this.getComunication = function () {return this.comunication;}

	
	/*
	* @itemAsDescribed: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayEvaluationObj){
		var evaluationString="";
		$.each(arrayEvaluationObj, function(index,evaluation){
			arrayEvaluationObj+="province number "+(index+1)+":"+evaluation.toString()+"\n";
		});
		return evaluationString;
	}
	
	/*
	* @itemAsDescribed: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var evaluationString="evaluationID= "+this.getEvaluationID()+ " swapID= "+this.getSwapID()+" itemAsDescribed= "+this.getItemAsDescribed()+ " comunication= "+this.getComunication();
		return evaluationString;
	}
}
