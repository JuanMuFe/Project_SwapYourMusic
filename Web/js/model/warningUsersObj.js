function warningUsersObj ()
{
	//Attributes declaration
	this.warningID;
	this.userID;
	this.read;
	
	//Methods declaration
	this.construct = function (warningID,userID, read)
	{
		this.setWarningID(warningID);
		this.setUserID(userID);
		this.setRead(read);
	}
	
	//getters and setters
	this.setWarningID = function (warningID){this.warningID=warningID;}
	this.setUserID = function (userID){this.userID=userID;}
	this.setRead = function (read){this.read=read;}
	
	this.getWarningID = function () {return this.warningID;}
	this.getUserID = function () {return this.userID;}
	this.getRead = function () {return this.read;}

	
	/*
	* @userID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @userID: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayWarningUsersObj){
		var warningUsersString="";
		$.each(arrayWarningUsersObj, function(index,warningUsers){
			arrayWarningUsersObj+="region number "+(index+1)+":"+warningUsers.toString()+"\n";
		});
		return warningUsersString;
	}
	
	/*
	* @userID: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @userID: this function formats the object data into a string
	* @date: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var warningUsersString="warningID= "+this.getWarningID()+ " userID= "+this.getUserID()+ " read= "+this.getRead();
		return warningUsersString;
	}
}
