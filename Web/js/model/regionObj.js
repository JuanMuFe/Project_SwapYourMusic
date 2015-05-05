function regionObj ()
{
	//Attributes declaration
	this.regionID;
	this.name;
	
	//Methods declaration
	this.construct = function (regionID,name)
	{
		this.setRegionID(regionID);
		this.setName(name);
	}
	
	//getters and setters
	this.setRegionID = function (regionID){this.regionID=regionID;}
	this.setName = function (name){this.name=name;}
	
	this.getRegionID = function () {return this.regionID;}
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
	this.arrayToString = function(arrayRegionObj){
		var regionString="";
		$.each(arrayRegionObj, function(index,region){
			arrayRegionObj+="region number "+(index+1)+":"+region.toString()+"\n";
		});
		return regionString;
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
		var regionString="regionID= "+this.getRegionID()+ " name= "+this.getName();
		return regionString;
	}
}
