function warningObj ()
{
	//Attributes declaration
	this.warningID;
	this.description;
	this.active;
	
	//Methods declaration
	this.construct = function (warningID,description, active)
	{
		this.setWarningID(warningID);
		this.setDescription(description);
		this.setActive(active);
	}
	
	//getters and setters
	this.setWarningID = function (warningID){this.warningID=warningID;}
	this.setDescription = function (description){this.description=description;}
	this.setActive = function (active){this.active=active;}
	
	this.getWarningID = function () {return this.warningID;}
	this.getDescription = function () {return this.description;}
	this.getActive = function () {return this.active;}

	
	/*
	* @description: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayWarningObj){
		var warningString="";
		$.each(arrayWarningObj, function(index,warning){
			arrayWarningObj+="region number "+(index+1)+":"+warning.toString()+"\n";
		});
		return warningString;
	}
	
	/*
	* @description: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var warningString="warningID= "+this.getWarningID()+ " description= "+this.getDescription()+ " active= "+this.getActive();
		return warningString;
	}
}
