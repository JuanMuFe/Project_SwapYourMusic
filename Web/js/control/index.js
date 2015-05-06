//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function($scope){
		
		
//PROPERTIES
		this.user= new userObj();
		
		$scope.flag = 0;
		$scope.userAction=1;
		$scope.passControl;
		$scope.passwordValid=true;
		$scope.userNameValid=true;
		$scope.emailValid=true;

//METHODS


/*
 *@name: login
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: this function controls if user exist in database and redirects depending if is admin user or normal user
 *@date: 2015/05/05
 *@params: none
 *@return: none
*/
		this.login = function(){
			var outPutData= new Array();
			this.user= angular.copy(this.user);
			
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
				
				$scope.passControl = this.user.getPassword();					
			
				if(!typeof(Storage)){
					alert("This browser does not accept local variables");
				}else{
					sessionStorage.setItem("userConnected", JSON.stringify(this.user));		
					
					if(this.user.getUserType()==0){  //if the user is admin, redirect to admin page with this administration methods
						window.open("adminWindow.html","_self");
					}else window.open("mainWindow.html", "_self");						
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
				if(user.userType==0) window.open("adminWindow.html","_self");
				else window.open("mainWindow.html","_self");
				
			}			
		}
		
/*
* @name: checkPassword()
* @author: Irene Blanco
* @version: 1.0
* @description: this function checks the password validation
* @date: 26/04/2015
* @params: none
* @return: none
*/ 
		this.checkPassword = function ()
		{
			if(this.user.password != this.passControl)
			{
				$scope.passwordValid = false;
				$("#password2").removeClass("ng-valid");
				$("#password2").addClass("ng-invalid");
			}
			else
			{
				$scope.passwordValid = true;
				$("#password2").removeClass("ng-invalid");
				$("#password2").addClass("ng-valid");
			}
		}
		
/*
* @name: checkUserName()
* @author: Irene Blanco 
* @version: 1.0
* @description: this function checks the existence of the userName
* @date: 26/04/2015
* @params: none
* @return: none
*/
		this.checkUserName = function ()
		{
				var outPutData= new Array();
				this.user= angular.copy(this.user);
				
				//connecting to the server in order to know if the nick
				//alrady exists
				$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=2\&JSONData='+JSON.stringify(this.user),
				  dataType: "json",				  
				  success: function (response) { 
					  outPutData = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
				  }					  
			});
			
			if(outPutData[0])
				{	
					var foundUserName = outPutData[0][1].userName;
					
					if(foundUserName!=this.user.getUserName()){
						$scope.userNameValid = true;
						$("#userName").removeClass("ng-valid");
						$("#userName").addClass("ng-invalid");
					}
					else{
						$scope.userNameValid = false;
						
						$("#userName").removeClass("ng-invalid");
						$("#userName").addClass("ng-valid");
					}					
					
				}
		}
		
	});
	
	swapYourMusicApp.directive("userDataManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/user-data-management.html",
		  controller:function(){

		  },
		  controllerAs: 'userDataManagement'
		};
	});
	
})();
