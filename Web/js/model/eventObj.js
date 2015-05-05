function eventObj ()
{
	//Attributes declaration
	this.eventID;
	this.name;
	this.description;
	this.date;
	this.place;
	
	//Methods declaration
	this.construct = function (eventID,name, description, date, place)
	{
		this.setEventID(eventID);
		this.setName(name);
		this.setDescription(description);
		this.setDate(date);
		this.setPlace(place);
	}
	
	//getters and setters
	this.setEventID = function (eventID){this.eventID=eventID;}
	this.setName = function (name){this.name=name;}
	this.setDescription = function (description){this.description=description;}
	this.setDate = function (date){this.date=date;}
	this.setPlace = function (place){this.place=place;}
	
	this.getEventID = function () {return this.eventID;}
	this.getName = function () {return this.name;}
	this.getDescription = function () {return this.description;}
	this.getDate = function () {return this.date;}
	this.getPlace = function () {return this.place;}

	
	/*
	* @name: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayEventObj){
		var eventString="";
		$.each(arrayEventObj, function(index,event){
			arrayEventObj+="event number "+(index+1)+":"+event.toString()+"\n";
		});
		return eventString;
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
		var eventString="eventID= "+this.getEventID()+ " name= "+this.getName()+ " description= "+this.getDescription()+ " date= "+this.getDate()+ " place= "+this.getPlace();
		return eventString;
	}
}
