function userObj ()
{
	//Attributes declaration
	this.userID;
	this.userType;
	this.userName;
	this.password;
	this.email;
	this.registerDate;
	this.unsubscribeDate;
	this.image;
	this.provinceID;
	
	
	//Methods declaration
	this.construct = function (userID,userType,userName, password, email, registerDate, unsibscribeDate, image, provinceID)
	{
		this.setUserID(userID);
		this.setUserType(userType);
		this.setUserName(userName);
		this.setPassword(password);
		this.setEmail(email);
		this.setRegisterDate(registerDate);
		this.setUnsubscribeDate(unsibscribeDate);
		this.setImage(image);
		this.setProvinceID(provinceID);
	}
	
	//getters and setters
	this.setUserID = function (userID){this.userID=userID;}
	this.setUserType = function (userType){this.userType=userType;}
	this.setUserName = function (userName){this.userName=userName;}
	this.setPassword = function (password){this.password=password;}
	this.setEmail = function (email){this.email=email;}
	this.setRegisterDate = function (registerDate){this.registerDate=registerDate;}
	this.setUnsubscribeDate = function (unsibscribeDate){this.unsibscribeDate=unsibscribeDate;}
	this.setImage = function (image){this.image=image;}
	this.setProvinceID = function (provinceID){this.provinceID=provinceID;}
	
	this.getUserID = function () {return this.userID;}
	this.getUserType = function () {return this.userType;}
	this.getUserName = function () {return this.userName;}
	this.getPassword = function () {return this.password;}
	this.getEmail = function () {return this.email;}
	this.getRegisterDate = function () {return this.registerDate;}
	this.getUnsubscribeDate = function () {return this.unsibscribeDate;}
	this.getImage = function () {return this.image;}
	this.getProvinceID = function () {return this.provinceID;}
	
	/*
	* @name: arrayToString()
	* @author: Irene Blanco
	* @version: 1.0
	* @description: this function formats in a friendly way the objects of an array
	* @date: 04/05/2015
	* @params: arrayClientObj - array of client objects
	* @return: clientString - well formed strng with all the users
	*/
	this.arrayToString = function(arrayUserObj){
		var userString="";
		$.each(arrayUserObj, function(index,user){
			arrayUserObj+="User number "+(index+1)+":"+user.toString()+"\n";
		});
		return userString;
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
		var userString="id= "+this.getUserID()+ " userType= "+this.getUserType()+" userName= "+this.getUserName()+" password= "+this.getPassword()+" email= "+this.getEmail()+" registerDate= "+this.getRegisterDate()+" unsubscribeDate= "+this.getUnsubscribeDate()+" image= "+this.getImage()+" provinceID= "+this.getProvinceID();
		return userString;
	}
}
