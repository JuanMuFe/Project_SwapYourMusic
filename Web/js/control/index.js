//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("swapYourMusicCtrl", function(){
		this.user= new userObj();
/*
 *@name: login
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: this function controls if user exist in database and redirects depending if is admin user or normal user
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/
		this.login = function(){
			var outPutData= new Array();
			this.user= angular.copy(this.user);
			this.user.setPassword(window.md5(this.user.password));
			
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=1\&JSONData='+JSON.stringify(this.user),
				  dataType: "json",				  
				  success: function (response) { 
					  outPutData = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
				  }					  
			});
			
			if(outPutData[0]){
				this.user = new userObj();
				this.user.construct(outPutData[1][0].userID, outPutData[1][0].userType, outPutData[1][0].userName, outPutData[1][0].password,
									outPutData[1][0].email, outPutData[1][0].registerDate, outPutData[1][0].unsubscribeDate, outPutData[1][0].image,
									outPutData[1][0].provinceID);
				
		
				if(!typeof(Storage)){
					alert("This browser does not accept local variables");
				}else{
					if(this.user.getUnsubscribeDate()=="0000-00-00"){ //users no cancelled
						sessionStorage.setItem("userConnected", JSON.stringify(this.user));		
					
						if(this.user.getUserType()==0){  //if the user is admin, redirect to admin page with this administration methods
							window.open("adminWindow.html","_self");
						}else window.open("mainWindow.html", "_self");
					}else alert("Your account is temporarily canceled.");										
				}					
			}else{
				showErrors(outPutData[1]);
			}
		}			
/*
 *@name: checkSession
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: This function controls if session called 'userConnected' exists and redirects in true case.
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/		
		this.checkSession = function(){
			var user = JSON.parse(sessionStorage.getItem("userConnected"));
			
			if(user!=null){
				window.open("mainWindow.html","_self");
			}			
		}
		
	});
})();
