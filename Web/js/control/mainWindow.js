//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function(){
		this.user= new userObj();
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
	
	swapYourMusicApp.controller("swapYourMusicCtrl", function(){
		this.user= new userObj();
		this.item= new itemObj();
		this.itemToAdd= new itemObj();
		this.genre= new genreObj();
		this.conditions= new conditionObj();
		
		//Data from DDBB
		this.itemsArray= new Array(); 
		this.genresArray= new Array();
		this.conditionsArray= new Array();
		this.itemTypesArray= new Array("Vinyl", "Cassete", "CD");
		
				
		var user = JSON.parse(sessionStorage.getItem("userConnected"));
			
		if(user!=null){
			this.user = new userObj();
			this.user.construct(user.userID, user.userType, user.userName, user.password, user.email, user.registerDate, user.unsubscribeDate, user.image, user.provinceID);
		}		
		
		this.accessMainData = function (){ 
			this.user= angular.copy(this.user);
			//calls to AJAX in order to search all items
			var outPutdata= new Array();
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=2&userID='+this.user.getUserID(), 
				  dataType: "json", 
				  success: function (response) { 
					  outPutdata = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});
			
			if (outPutdata[0]){		
				for (var i = 0; i < outPutdata[1].length; i++){
					if(outPutdata[1][i].available==1){
						var item = new itemObj();
						item.construct(outPutdata[1][i].itemID, outPutdata[1][i].userID,outPutdata[1][i].itemType, outPutdata[1][i].title,
										outPutdata[1][i].artist, outPutdata[1][i].releaseYear,outPutdata[1][i].genreID,outPutdata[1][i].conditionID,
										outPutdata[1][i].image,outPutdata[1][i].available);	
						this.itemsArray.push(item);	
						this.item.setUserID(outPutdata[1][i].userID);				
					}									
				}				
			}
			else showErrors(outPutdata[1]);
					
			//calls to AJAX in order to search all genres
			var outPutdata= new Array(); 
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=3', 
				  dataType: "json", 
				  success: function (response) { 
					  outPutdata = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});
			
			if (outPutdata[0]){		
				for (var i = 0; i < outPutdata[1].length; i++){
					this.genre = new genreObj();
					this.genre.construct(outPutdata[1][i].genreID, outPutdata[1][i].name);	
					this.genresArray.push(this.genre);					
				}			
			}
			else showErrors(outPutdata[1]);
			
			//calls to AJAX in order to search all conditions
			var outPutdata= new Array(); 
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=4', 
				  dataType: "json", 
				  success: function (response) { 
					  outPutdata = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});
			
			if (outPutdata[0]){		
				for (var i = 0; i < outPutdata[1].length; i++){
					this.condition = new conditionObj();
					this.condition.construct(outPutdata[1][i].conditionID, outPutdata[1][i].name);	
					this.conditionsArray.push(this.condition);					
				}			
			}
			else showErrors(outPutdata[1]);
		}
		
		this.addItem= function(){			
			//Uploading files
			var itemImageArray = imagesItemManagement(this.item.userID);
			
			this.item = angular.copy(this.item);
			this.item.setItemID(0);
			this.item.setAvailable(1);
			this.item.setImage(itemImageArray[0]);
			var idItem;
			
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=5&JSONData='+JSON.stringify(this.item),
				  dataType: "json",
				  success: function (response) { 
					  idItem = response;
					  alert("Item inserted correctly");
				  },
				  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
				  }	
			});			
		}
		
		this.deleteItem= function(){
			if(confirm("Are you sure you want delete this item?")){	
				
				for (var i = 0; i <this.items.length; i++){
					if($("#delete"+i)){
						
					}
				}
							
				this.item = angular.copy(this.item);
				this.item.setAvailable(0);
				
				$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=6&JSONData='+JSON.stringify(this.item),
				  dataType: "json",
				  success: function (response) { 
					  idItem = response;
					  alert("Item deleted correctly");
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert(xhr.status+"\n"+thrownError);
				  }	
				});
			}
		}
			
		
	});
	
	//Templates of the application
	swapYourMusicApp.directive("userProfileManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/user-profile-management.html",
		  controller:function(){
			
		  },
		  controllerAs: 'userProfileManagement'
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

//jQuery code
function imagesItemManagement(userID){
	var imagesArrayToSend = new FormData();
	
	var imageFile = $("#itemImage")[0].files[0];
		
	imagesArrayToSend.append('images[]', imageFile);
	var filesNamesArray = new Array();

	$.ajax({
		url : 'php/control/controlFiles.php?action=1&titleItem='+$("#title").val()+'&userID='+userID,
        type : 'POST',
        async: false,
        data : imagesArrayToSend,
        dataType: "json",
        processData : false, 
        contentType : false, 
        success : function(response){
            filesNamesArray = response;
        },
        error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status+"\n"+thrownError);
		}                
    });	
	
	return filesNamesArray;
}
