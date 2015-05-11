function userObj ()
{
	//Attributes declaration
	this.provinceID;
	this.name;
	this.regionID;
	
	//Methods declaration
	this.construct = function (provinceID,name, regionID)
	{
		this.setProvinceID(provinceID);
		this.setName(name);
		this.setRegionID(regionID);
	}
	
	//getters and setters
	this.setProvinceID = function (provinceID){this.provinceID=provinceID;}
	this.setName = function (name){this.name=name;}
	this.setRegionID = function (regionID){this.regionID=regionID;}

	
	this.getProvinceID = function () {return this.provinceID;}
	this.getName = function () {return this.name;}
	this.getRegionID = function () {return this.regionID;}

	
	/*
	* @name: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayProvinceObj){
		var provinceString="";
		$.each(arrayProvinceObj, function(index,province){
			arrayProvinceObj+="province number "+(index+1)+":"+province.toString()+"\n";
		});
		return provinceString;
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
		var provinceString="provinceID= "+this.getProvinceID()+ " name= "+this.getName()+ " regionID= "+this.getRegionID();
		return provinceString;
	}
}
