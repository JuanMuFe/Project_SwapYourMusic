function swapObj ()
{
	//Attributes declaration
	this.messageID;
	this.swapID;
	this.date;
	this.content;
		
	//Methods declaration
	this.construct = function (messageID,swapID, date, content)
	{
		this.setMessageID(messageID);
		this.setSwapID(swapID);
		this.setDate(date);
		this.setContent(content);
	}
	
	//getters and setters
	this.setMessageID = function (messageID){this.messageID=messageID;}
	this.setSwapID = function (swapID){this.swapID=swapID;}
	this.setDate = function (date){this.date=date;}
	this.setContent = function (content){this.content=content;}
	
	this.getMessageID = function () {return this.messageID;}
	this.getSwapID = function () {return this.swapID;}
	this.getDate = function () {return this.date;}
	this.getContent = function () {return this.content;}
	
	/*
	* @swapID: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @date: this function formats in a friendly way the objects of an array
	* @content: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/ 
	this.arrayToString = function(arrayMessageObj){
		var messageString="";
		$.each(arrayMessageObj, function(index,message){
			arrayMessageObj+="swap number "+(index+1)+":"+message.toString()+"\n";
		});
		return messageString;
	}
	
	/*
	* @swapID: toString()
	* @author: Irene Blanco
	* @version: 1.0
	* @date: this function formats the object data into a string
	* @content: 04/05/2015
	* @params: none
	* @return: clientString - well formed strng with all the object data
	*/ 
	this.toString = function(){
		var messageString="messageID= "+this.getMessageID()+ " swapID= "+this.getSwapID()+ " date= "+this.getDate()+ " content= "+this.getContent();
		return messageString;
	}
}
