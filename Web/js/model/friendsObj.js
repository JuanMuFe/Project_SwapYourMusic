function warningUsersObj ()
{
	//Attributes declaration
	this.friendID;
	this.userID;
	
	//Methods declaration
	this.construct = function (friendID,userID)
	{
		this.setFriendID(friendID);
		this.setUserID(userID);
	}
	
	//getters and setters
	this.setFriendID = function (friendID){this.friendID=friendID;}
	this.setUserID = function (userID){this.userID=userID;}
	
	this.getFriendID = function () {return this.friendID;}
	this.getUserID = function () {return this.userID;}

	
	/*
	* @userID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @userID: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayFriendsObj){
		var friendsString="";
		$.each(arrayFriendsObj, function(index,warningUsers){
			arrayFriendsObj+="region number "+(index+1)+":"+warningUsers.toString()+"\n";
		});
		return friendsString;
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
		var friendsString="friendID= "+this.getFriendID()+ " userID= "+this.getUserID();
		return friendsString;
	}
}
