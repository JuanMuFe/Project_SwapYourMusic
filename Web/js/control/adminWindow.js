//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function($scope){
		
		
//PROPERTIES
		this.loggedUser= new userObj();
		$scope.flag=0;		

//METHODS



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
			
			if(user==null) window.open("index.html","_self");	
			else if(user.userType==1) window.open("mainWindow.html","_self");
			else{
				this.loggedUser.construct(user.userID, user.userType, user.userName, user.password,
									user.email, user.registerDate, user.unsubscribeDate, user.image,
									user.provinceID);
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
	
	
//ADMIN CONTROLLER
	swapYourMusicApp.controller("adminController", function($scope){
		
//PROPERTIES
		this.usersArray = new Array();
		this.provincesArray = new Array();
		
		this.nameToSearch;
		this.user = new userObj();//user to modify
		this.currEmail;
		this.currUserName;
		
		this.allRegionsArray = new Array();
		this.allProvincesArray = new Array();
		this.selectedRegion;
		this.regionToSearch;
	
		$scope.usersFlag = 0;
		$scope.flag;
		$scope.passControl;
		$scope.passwordValid = true;
		$scope.userNameValid = true;
		$scope.emailValid = true;
		$scope.noUsers = true;
		
//METHODS
/*
 *@name: loadUsers
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function loads all the "client" users
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/			
		this.loadUsers = function(){			
			this.usersArray = new Array();
			this.provincesArray = new Array();
	
			if(this.nameToSearch!=""||this.regionToSearch!="") {			
				
				$scope.usersFlag = 0;				
				var outPutData= new Array();						
				
				if(this.nameToSearch!="" && (this.regionToSearch=="" || this.regionToSearch==undefined)){
					this.provincesArray = new Array();
						//getting the client users
						$.ajax({
							  url: 'php/control/control.php',
							  type: 'POST',
							  async: false,
							  data: 'action=55&userName='+this.nameToSearch,
							  dataType: "json",				  
							  success: function (response) { 
								  outPutData = response;
							  },
							  error: function (xhr, ajaxOptions, thrownError) {
									alert(xhr.status+"\n"+thrownError);
							  }					  
						});	
				}			
				else if((this.nameToSearch==undefined || this.nameToSearch=="") && this.regionToSearch!=""){
					$.ajax({
						  url: 'php/control/control.php',
						  type: 'POST',
						  async: false,
						  data: 'action=58&regionID='+this.regionToSearch,
						  dataType: "json",				  
						  success: function (response) { 
							  outPutData = response;
						  },
						  error: function (xhr, ajaxOptions, thrownError) {
								alert(xhr.status+"\n"+thrownError);
						  }					  
					});
				}
				else if(this.nameToSearch!="" && this.regionToSearch!=""){
						$.ajax({
						  url: 'php/control/control.php',
						  type: 'POST',
						  async: false,
						  data: 'action=59&regionID='+this.regionToSearch+'&userName='+this.nameToSearch,
						  dataType: "json",				  
						  success: function (response) { 
							  outPutData = response;
						  },
						  error: function (xhr, ajaxOptions, thrownError) {
								alert(xhr.status+"\n"+thrownError);
						  }					  
					});
				}
				
				if(outPutData[0]){
					$scope.noUsers = false;
					for (var i = 0; i < outPutData[1].length; i++)
					{
						var user = new userObj();
						user.construct(outPutData[1][i].userID, outPutData[1][i].userType, outPutData[1][i].userName, outPutData[1][i].password,
										outPutData[1][i].email, outPutData[1][i].registerDate, outPutData[1][i].unsubscribeDate, outPutData[1][i].image,
										outPutData[1][i].provinceID);		
						
						this.usersArray.push(user);					
						
						var province = new provinceObj();
						province.construct(outPutData[2][i].provinceID, outPutData[2][i].name,outPutData[2][i].regionID);
						this.provincesArray.push(province);
					}			
						
				}
				else $scope.noUsers = true;
			}
			else $scope.noUsers = true;
		}
		
/*
 *@name: deleteUser
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function puts an unsubscribeDate to the selected user
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/			
		this.deleteUser = function(index){
			
			var confirmDelete = confirm("Are you sure that you want to unsubscribe this user?");
		
			if(confirmDelete){
				this.usersArray[index].setUnsubscribeDate(new Date());
				
				$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=56&JSONData='+JSON.stringify(this.usersArray[index]),
				  dataType: "json",
				  success: function (response) { 
					  error = false;
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
						error = true;
				  }	
				});
			
				if(!error)
				{
					alert("The user is now usubscribed.");	
					this.usersArray = new Array();
					this.loadUsers();		
					
				}
			
			}
		}
		
/*
 *@name: modifyUser
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/05
 *@params: none
 *@return: none
 *
*/			
		this.modifyUser = function(index){

				this.user = this.usersArray[index];		
				$scope.passControl = this.user.getPassword();
				
				this.selectedRegion = this.provincesArray[index].getRegionID();
				
				this.currEmail = this.user.getEmail() ;
				this.currUserName = this.user.getUserName() ;

				$scope.usersFlag=1;	
		}
		
		/*
		* @name: userManagement()
		* @author: Irene Blanco
		* @version: 1.0
		* @description: this function manages the modification of the user
		* the database
		* @date: 07/05/2015
		* @params: none
		* @return: none
		*/
		this.userManagement = function ()
		{
			var confirmModify = confirm("Are you sure that you want to modify this user?");
			
			if(confirmModify){
				this.user=angular.copy(this.user);

				var imageUserMod = $("#imageUserMod")[0].files[0];
				
				if(imageUserMod != undefined)
				{
					var imagesNameArray = userImagesManagement(this.user.getUserName(), this.user.getImage());
					this.user.setImage(imagesNameArray[0]);	
				}			
							
				var error = false;
				
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=57&JSONData='+JSON.stringify(this.user),
					  dataType: "json",
					  success: function (response) { 
						  
					  },
					  error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.status+"\n"+thrownError);
							error = true;
					  }	
				});
				
				if(!error)
				{
					alert("User correctly modified!");	
					$scope.usersFlag=0;	
					this.usersArray = new Array();
					this.loadUsers();
					//location.reload();
					
				}
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
			if(this.user.password != $scope.passControl)
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
				if (this.user.userName!=undefined && this.user.userName!=this.currUserName){
				
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
				
				if (this.user.email!=undefined && this.user.email!=this.currEmail){
				
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
					this.allRegionsArray.push(region);
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
			this.allProvincesArray = new Array();			
						
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
						this.allProvincesArray.push(province);
					}			
						
				}
			}			
		}

		
	});
	
	swapYourMusicApp.directive("userDataAdminManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/user-data-admin-management.html",
		  controller:function(){

		  },
		  controllerAs: 'userDataAdminManagement'
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
	
	swapYourMusicApp.directive('calendar', function () {
            return {
                require: 'ngModel',
                link: function (scope, el, attr, ngModel) {
                    $(el).datepicker({
                        dateFormat: 'yy-mm-dd',
                        onSelect: function (dateText) {
                            scope.$apply(function () {
                                ngModel.$setViewValue(dateText);
                            });
                        }
                    });
                }
            };
     });	
	
	swapYourMusicApp.directive("usersAdminManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/users-admin-management.html",
		  controller:function(){

		  },
		  controllerAs: 'usersAdminManagement'
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
* @params: userName, imageName
* @return: none
		*/
function userImagesManagement(userNick, imageName)
{
	//Remove image
	var imagesNameArray=new Array();
	imagesNameArray.push(imageName);
	
	$.ajax({
		url : 'php/control/controlFiles.php',
        type : 'POST',
        async: false,
        data : 'action=51&JSONData='+JSON.stringify(imagesNameArray),
        dataType: "json",
        //~ beforesend:
        //~ complete: 
        success : function(response){
                   
        },
        error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status+"\n"+thrownError);
		}                
    });
    
	
	//Upload image
	var imageFiles = new FormData();
	var nicksArray = new Array();
	nicksArray.push(userNick);
	
	var image = $("#imageUserMod")[0].files[0];
	

	imageFiles.append('images[]',image);
	
	var serverFileNames = new Array();
	
	$.ajax({
		url : 'php/control/controlFiles.php?action=50&userNamesArray='+JSON.stringify(nicksArray),
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


 



