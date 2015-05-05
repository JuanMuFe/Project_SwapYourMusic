function conditionObj ()
{
	//Attributes declaration
	this.conditionID;
	this.name;
	
	//Methods declaration
	this.construct = function (conditionID,name)
	{
		this.setConditionID(conditionID);
		this.setName(name);
	}
	
	//getters and setters
	this.setConditionID = function (conditionID){this.conditionID=conditionID;}
	this.setName = function (name){this.name=name;}
	
	this.getConditionID = function () {return this.conditionID;}
	this.getName = function () {return this.name;}

	
	/*
	* @name: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayConditionObj){
		var conditionString="";
		$.each(arrayConditionObj, function(index,condition){
			arrayConditionObj+="region number "+(index+1)+":"+condition.toString()+"\n";
		});
		return conditionString;
	}
	
	/*
	* @name: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var conditionString="conditionID= "+this.getConditionID()+ " name= "+this.getName();
		return conditionString;
	}
}
