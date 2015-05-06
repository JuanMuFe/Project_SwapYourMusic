//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function($scope){
		
		
//PROPERTIES
		this.user= new userObj();
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
				this.user.construct(user.userID, user.userType, user.userName, user.password,
									user.email, user.registerDate, user.unsubscribeDate, user.image,
									user.provinceID);
			}						
		}
		
		
		
	});
	
	
//ADMIN CONTROLLER
	swapYourMusicApp.controller("adminController", function($scope){
		
//PROPERTIES
		this.usersArray = new Array();


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
			
			var outPutData= new Array();
						
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=55',
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
					var user = new userObj();
					user.construct(outPutData[1][0].userID, outPutData[1][0].userType, outPutData[1][0].userName, outPutData[1][0].password,
									outPutData[1][0].email, outPutData[1][0].registerDate, outPutData[1][0].unsubscribeDate, outPutData[1][0].image,
									outPutData[1][0].provinceID);		
					this.usersArray.push(user);
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
