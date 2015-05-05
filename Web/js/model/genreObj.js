function genreObj ()
{
	//Attributes declaration
	this.genreID;
	this.name;
	
	//Methods declaration
	this.construct = function (genreID,name)
	{
		this.setGenreID(genreID);
		this.setName(name);
	}
	
	//getters and setters
	this.setGenreID = function (genreID){this.genreID=genreID;}
	this.setName = function (name){this.name=name;}
	
	this.getGenreID = function () {return this.genreID;}
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
	this.arrayToString = function(arrayGenreObj){
		var genreString="";
		$.each(arrayGenreObj, function(index,genre){
			arrayGenreObj+="region number "+(index+1)+":"+genre.toString()+"\n";
		});
		return genreString;
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
		var genreString="genreID= "+this.getGenreID()+ " name= "+this.getName();
		return genreString;
	}
}
