//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("swapYourMusicCtrl", function(){
/*
 *@name: checkSession
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: This function controls if session called 'userConnected' exists and redirects in false case. 
 * 				If that's true constructs the user object.
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/		
		this.checkSession = function(){ 
			var user = JSON.parse(sessionStorage.getItem("userConnected"));
			
			if(user!=null){
				this.user = new userObj();
				this.user.construct(user.userID, user.userType, user.userName, user.password, user.email, user.registerDate, user.unsubscribeDate, user.image, user.provinceID);
				//$scope.password2=this.user.getPassword();
			}else{
				window.open("index.html","_self");
			}			
		}
/*
 *@name: logOut
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: This function removes the session called 'userConnected' and redirects to index.
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/		
		this.logOut= function(){
			sessionStorage.removeItem("userConnected");			
			window.open("index.html","_self");
		}
	});
})();
