//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function($scope){
		
		
//PROPERTIES
		this.user= new userObj();
		this.regionsArray = new Array();
		this.provincesArray = new Array();
		this.selectedRegion;
		
		$scope.flag=0;
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
				if (this.user.userName!=undefined){
				
					var outPutData= new Array();
					this.user= angular.copy(this.user);
					
					//connecting to the server in order to know if the nick
					//alrady exists
					$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=50\&JSONData='+JSON.stringify(this.user),
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
						var foundUserName = outPutData[1][0].userName;
						
						if(foundUserName!=this.user.getUserName()){
							$scope.userNameValid = true;
							$("#userName").removeClass("ng-invalid");
							$("#userName").addClass("ng-valid");
						}
						else{
							$scope.userNameValid = false;							
							$("#userName").removeClass("ng-valid");
							$("#userName").addClass("ng-invalid");
						}					
						
					}
					else {
						$scope.userNameValid = true;
						$("#userName").removeClass("ng-invalid");
						$("#userName").addClass("ng-valid");
					}
				}
		}
		
/*
* @name: checkEmail()
* @author: Irene Blanco 
* @version: 1.0
* @description: this function checks the existence of the email
* @date: 26/04/2015
* @params: none
* @return: none
*/
		this.checkEmail = function ()
		{
				if (this.user.email!=undefined){
				
					var outPutData= new Array();
					this.user= angular.copy(this.user);
					
					//connecting to the server in order to know if the nick
					//alrady exists
					$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=51\&JSONData='+JSON.stringify(this.user),
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
						var foundEmail = outPutData[1][0].email;
						
						if(foundEmail!=this.user.getEmail()){
							$scope.emailValid = true;
							$("#email").removeClass("ng-invalid");
							$("#email").addClass("ng-valid");
							
						}
						else{
							$scope.emailValid = false;							
							$("#email").removeClass("ng-valid");
							$("#email").addClass("ng-invalid");							
						}					
						
					}
					else {
						$scope.emailValid = true;
						$("#email").removeClass("ng-invalid");
						$("#email").addClass("ng-valid");
					}
				}
		}
		
/*
 *@name: loadRegions
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: this function controls loads all the regions
 *@date: 2015/05/05
 *@params: none
 *@return: none
*/
		this.loadRegions = function(){
			var outPutData= new Array();
						
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=52',
				  dataType: "json",				  
				  success: function (response) { 
					  outPutData = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
				  }					  
			});
			
			if(outPutData[0]){
				for (var i = 0; i < outPutData[1].length; i++)
				{
					var region = new regionObj();
					region.construct(outPutData[1][i].regionID, outPutData[1][i].name);					
					this.regionsArray.push(region);
				}			
					
			}			
		}
		
/*
 *@name: loadProvincesByRegion
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: this function loads all the provinces by region
 *@date: 2015/05/05
 *@params: none
 *@return: none
*/
		this.loadProvincesByRegion = function(){
			var outPutData= new Array();
			this.provincesArray = new Array();			
			this.user.setProvinceID("");
			
			if(this.selectedRegion!=undefined){
			
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=53\&regionID='+this.selectedRegion,
					  dataType: "json",				  
					  success: function (response) { 
						  outPutData = response;
					  },
					  error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.status+"\n"+thrownError);
					  }					  
				});
				
				if(outPutData[0]){
					for (var i = 0; i < outPutData[1].length; i++)
					{
						var province = new provinceObj();
						province.construct(outPutData[1][i].provinceID, outPutData[1][i].name);					
						this.provincesArray.push(province);
					}			
						
				}
			}			
		}
		
/*
* @name: userManagement()
* @author: Irene Blanco
* @version: 1.0
* @description: this function manages the insertion of a new user into
* the database
* @date: 26/04/2015
* @params: none
* @return: none
*/
		this.userManagement = function ()
		{
			var imagesNameArray = imagesManagement(this.user.getUserName());
			this.user.setImage(imagesNameArray[0]);
			this.user.setUserID(0);
			this.user.setUserType(1);
			this.user.setUnsubscribeDate('0000-00-00');
			this.user.setRegisterDate(new Date());
			
			this.user=angular.copy(this.user);
			
			var idUser;
			var error = false;
			//inserting the USER to the database
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=54&JSONData='+JSON.stringify(this.user),
				  dataType: "json",
				  success: function (response) { 
					  userID = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
						error = true;
				  }	
			});
			
			if(!error)
			{
				this.user.setUserID(userID);
				sessionStorage.setItem("userConnected",JSON.stringify(this.user));
				window.open("mainWindow.html","_self");			
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
	
	swapYourMusicApp.directive('file', function(){
		return {
			scope: {
				file: '='
			},
			link: function(scope, el, attrs){
				el.bind('change', function(event){
					var files = event.target.files;
					var file = files[0];
					scope.file = file ? file.name : undefined;
					scope.$apply();
				});
			}
		};
	});	
	
})();


 //Own our code
 
 /*
		* @name: imagesManagement()
		* @author: Irene Blanco
		* @version: 1.0
		* @description: this function manages the images
		* the database
		* @date: 26/04/2015
		* @params: userNick
		* @return: none
		*/
function imagesManagement(userName)
{
	var imageFiles = new FormData();
	var userNamesArray = new Array();
	userNamesArray.push(userName);
	
	var image = $("#imageUser")[0].files[0];
	
	//File name
	var fileName = image.name;
	
	//File type
	var fileType = image.type;
	
	//File size
	var fileSize = image.size;
	
	imageFiles.append('images[]',image);
	
	var serverFileNames = new Array();
	
	$.ajax({
		url : 'php/control/controlFiles.php?action=50&userNamesArray='+JSON.stringify(userNamesArray),
        type : 'POST',
        async: false,
        data : imageFiles,
        dataType: "json",
        //~ beforesend:
        //~ complete:
        processData : false, 
        contentType : false, 
        success : function(response){
                   serverFileNames = response;
        },
        error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status+"\n"+thrownError);
		}                
    });
    
    return serverFileNames;
	
}
