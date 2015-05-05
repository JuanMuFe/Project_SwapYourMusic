function eventsAssistanceObj ()
{
	//Attributes declaration
	this.userID;
	this.eventID;
	
	//Methods declaration
	this.construct = function (userID,eventID)
	{
		this.setUserID(userID);
		this.setEventID(eventID);
	}
	
	//getters and setters
	this.setUserID = function (userID){this.userID=userID;}
	this.setEventID = function (eventID){this.eventID=eventID;}
	
	this.getUserID = function () {return this.userID;}
	this.getEventID = function () {return this.eventID;}

	
	/*
	* @eventID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayEventAssistanceObj){
		var eventsAssistanceString="";
		$.each(arrayEventAssistanceObj, function(index,eventAssistance){
			arrayEventAssistanceObj+="event assistance number "+(index+1)+":"+eventAssistance.toString()+"\n";
		});
		return eventsAssistanceString;
	}
	
	/*
	* @eventID: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var eventsAssistanceString="userID= "+this.getUserID()+ " eventID= "+this.getEventID();
		return eventsAssistanceString;
	}
}
