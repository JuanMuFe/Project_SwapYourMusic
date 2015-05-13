//JQuery code
$(document).ready(function(){
	$("#userItemsMod").hide();
});

//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", []);
	
	swapYourMusicApp.controller("sessionController", function($scope){
		this.user= new userObj();
		$scope.userPage=2;
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
	
	swapYourMusicApp.controller("swapYourMusicCtrl", function($scope){
		this.user= new userObj();
		this.item= new itemObj();
		this.itemToAdd= new itemObj();
		this.genre= new genreObj();
		this.conditions= new conditionObj();
		this.warningsUser= new warningUsersObj();
		this.warnings= new warningObj();
		this.friend= new friendsObj();
		$scope.imagesArray= new Array();
		$scope.warningRead=0;
		
		//Data from DDBB
		this.itemsArray= new Array(); 
		this.itemsArrayHome= new Array();
		this.genresArray= new Array();
		this.conditionsArray= new Array();
		this.usersArray= new Array();
		this.itemTypesArray= new Array("Vinyl", "Cassete", "CD");
		this.friendsArray= new Array();
		this.provincesArray= new Array();
		this.warningsArray= new Array();
		this.warningsToShowArray= new Array();
		
				
		var user = JSON.parse(sessionStorage.getItem("userConnected"));
			
		if(user!=null){
			this.user = new userObj();
			this.user.construct(user.userID, user.userType, user.userName, user.password, user.email, user.registerDate, user.unsubscribeDate, user.image, user.provinceID);
		}		
		
		this.accessMainData = function (){ 
			this.user= angular.copy(this.user);	
					
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
			
			//calls to AJAX in order to search all items to put in home
			var outPutdata= new Array(); 
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=8&limitNumber='+10,   // limitNumber=10 is the number of items that the admin wants to appear in the home
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
					if(outPutdata[1][i].available==1 && (outPutdata[1][i].userID!=this.user.getUserID())){
						var item = new itemObj();
						item.construct(outPutdata[1][i].itemID, outPutdata[1][i].userID, outPutdata[1][i].bidID,outPutdata[1][i].itemType, outPutdata[1][i].title,
											outPutdata[1][i].artist, outPutdata[1][i].releaseYear,outPutdata[1][i].genreID,outPutdata[1][i].conditionID,
											outPutdata[1][i].image,outPutdata[1][i].available, outPutdata[1][i].uploadDate);	
						this.itemsArrayHome.push(item);
					}										
				}	
				
				for (var i = 0; i < outPutdata[2].length; i++){
					if(outPutdata[2][i].unsubscribeDate=="0000-00-00" && (outPutdata[2][i].userID!=this.user.getUserID())){
						var user= new userObj();
						user.construct(outPutdata[2][i].userID, outPutdata[2][i].userType, outPutdata[2][i].userName, outPutdata[2][i].password, 
									   outPutdata[2][i].email, outPutdata[2][i].registerDate, outPutdata[2][i].unsubscribeDate, outPutdata[2][i].image,
									   outPutdata[2][i].provinceID);
						this.usersArray.push(user);
					}
				}	
			}
			else showErrors(outPutdata[1]);
		}
		
		this.loadUserItems= function(){
			//calls to AJAX in order to search all items
			var outPutdata= new Array();
			this.itemsArray= new Array();
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
						$scope.userItems=0;
						var item = new itemObj();
						item.construct(outPutdata[1][i].itemID, outPutdata[1][i].userID, outPutdata[1][i].bidID, outPutdata[1][i].itemType, outPutdata[1][i].title,
										outPutdata[1][i].artist, outPutdata[1][i].releaseYear,outPutdata[1][i].genreID,outPutdata[1][i].conditionID,
										outPutdata[1][i].image,outPutdata[1][i].available,outPutdata[1][i].uploadDate);	
						this.itemsArray.push(item);	
						this.item.setUserID(outPutdata[1][i].userID);
						$scope.imagesArray.push(outPutdata[1][i].image);				
					}									
				}			
			}else{
				$("#userItemsMeesage").html("Still it does not have any item added");
				$("#userItemsTable").hide();
			}
		}
		
		this.addItem= function(){				
			//Uploading files
			var itemImage = imagesItemManagement(this.item.userID);
			var now = new Date();

			var month = now.getMonth()+1;
			var day = now.getDate();
				if(day<10) day= "0"+day;
				if(month<10) month= "0"+month;					
			var year = now.getFullYear();
			var hours= now.getHours();
			var minutes= now.getMinutes();				
			var seconds= now.getSeconds();
				if(hours<10) hours= "0"+hours;
				if(minutes<10) minutes= "0"+minutes;
				if(seconds<10) seconds= "0"+seconds;
			var currentDateHour= year+"-"+month+"-"+day+" "+hours+":"+minutes+":"+seconds;
	
			this.item.setItemID(0);
			this.item.setAvailable(1);
			this.item.setImage(itemImage[0]);
			this.item.setUploadDate(currentDateHour);
			
			this.item = angular.copy(this.item);
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
			
			if(idItem!=null){
				$scope.userPage=2;
				this.item= new itemObj();
				this.loadUserItems();	
			} 	
		}
		
		this.deleteItem= function(itemIDToDelete){
			if(confirm("Are you sure you want delete this item?")){	
				for (var i = 0; i <this.itemsArray.length; i++){
					if(this.itemsArray[i].getItemID()==itemIDToDelete){					
						var item= new itemObj();						
						item.construct(this.itemsArray[i].itemID, this.itemsArray[i].userID, this.itemsArray[i].bidID, this.itemsArray[i].itemType,
										this.itemsArray[i].title,this.itemsArray[i].artist,this.itemsArray[i].releaseYear,
										this.itemsArray[i].genreID,this.itemsArray[i].conditionID,this.itemsArray[i].image,
										this.itemsArray[i].available);
						item.setAvailable(0);
					}
				}
							
				item = angular.copy(item);
				var idItem;
				$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=6&JSONData='+JSON.stringify(item),
				  dataType: "json",
				  success: function (response) { 
					  idItem = response;
					  alert("Item deleted correctly");					  
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert(xhr.status+"\n"+thrownError);
				  }	
				});
				
				if(idItem!=null){
					this.loadUserItems();
				}				
			}
		}
		
		this.searchItems= function(){							
			if((this.item.getItemType()!=null && this.item.getItemType()!="") || (this.item.getGenreID()!=null && this.item.getGenreID()!="") || (this.item.getArtist()!=null && this.item.getArtist()!="")){
				this.item= angular.copy(this.item);	
				this.itemsArrayHome= new Array();		
				var outPutdata= new Array();			
				
				var itemType= ((typeof this.item.getItemType() == "undefined") ? '' : this.item.getItemType());
				var genreID=((typeof this.item.getGenreID() == "undefined") ? '' : this.item.getGenreID());
				var artist= ((typeof this.item.getArtist() == "undefined") ? '' : this.item.getArtist());		
				
				$.ajax({
					url: 'php/control/control.php',  
					type: 'POST',  
					async: false,   
					data: 'action=9&itemType='+itemType+'&genreID='+genreID+'&artist='+artist, 
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
					$("#searchMessage").hide();	
					for (var i = 0; i < outPutdata[1].length; i++){
						if(outPutdata[1][i].available==1 && (outPutdata[1][i].userID!=this.user.getUserID())){
							var item = new itemObj();
							item.construct(outPutdata[1][i].itemID, outPutdata[1][i].userID, outPutdata[1][i].bidID, outPutdata[1][i].itemType, outPutdata[1][i].title,
											outPutdata[1][i].artist, outPutdata[1][i].releaseYear,outPutdata[1][i].genreID,outPutdata[1][i].conditionID,
											outPutdata[1][i].image,outPutdata[1][i].available,outPutdata[1][i].uploadDate);	
							this.itemsArrayHome.push(item);					
						}							
					}				
				}else{
					$("#searchMessage").html("No items have been found into the databse");
					$("#searchMessage").fadeIn(500);	
				}					
			}			
		}			
		
		
		this.createModItemForm= function(item){
			this.item= new itemObj();
			this.item.construct(item.itemID, item.userID, item.bidID, item.itemType, item.title, item.artist, item.releaseYear,
								item.genreID, item.conditionID,item.image, item.userID,item.available);
			$("#userItemsManag").hide();			
			$("#userItemsMod").fadeIn(1000);
		}
		
		this.modifyItem= function(){			
			if(confirm("Are you sure you want modify this item/s?")){
				var imagesNames = filesManagementToModItems(this.item);
				
				//New files modification				
				this.item.setImage(imagesNames[0]);
				
				var dateToGetYear = new Date();
				var year = dateToGetYear.getFullYear();
				
				if(this.item.getReleaseYear()>year){
					alert("You must introduce a valid release year");
				}																	
				
				//Item type, genreID and conditionID modification				
				this.item.setItemType($("#itemTypeMod").find('option:selected').attr('value'));	
				this.item.setGenreID($("#genreMod").find('option:selected').attr('value'));	
				this.item.setConditionID($("#conditionMod").find('option:selected').attr('value'));	
				this.item.setAvailable(1);				
				
				this.item = angular.copy(this.item);	
				
				$.ajax({
					url: 'php/control/control.php',
					type: 'POST',
					async: true,
					data: 'action=7&JSONItemToMod='+JSON.stringify(this.item),
					dataType: "json",
					success: function (response) { 
						  alert("Item correctly modified in the system");
					},
					error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status+"\n"+thrownError);
					}	
				});			
			}
		}
		
		this.hideShowWindows= function(){
			$("#userItemsManag").fadeIn(1000);			
			$("#userItemsMod").hide();
		}
		
		this.deleteAccount= function(){
			var passToConfirm= $("#passwordToDelete").val();
			
			if(window.md5(passToConfirm)==this.user.password){	
				for (var i = 0; i < this.itemsArray.length; i++){  
					this.itemsArray[i].setAvailable(0);						
				}
				//call in ajax in order to put available=0 for this user items
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=7&JSONItemToMod='+JSON.stringify(this.itemsArray),
					  dataType: "json",
					  success: function (response){ 
						  success = response;
						  alert("Account deleted successful");
					  },
					  error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.status+"\n"+thrownError);
					  }	
				});
							
				$("#message").hide();
				if(confirm("Are you sure you want to delete your account?")){
					var now = new Date();

					var month = now.getMonth()+1;
					var day = now.getDate();
						if(day<10) day= "0"+day;
						if(month<10) month= "0"+month;					
					var year = now.getFullYear();
					var currentDate= year+"-"+month+"-"+day;
					
					this.user.setUnsubscribeDate(currentDate);
					
					var success;
					$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=57&JSONData='+JSON.stringify(this.user),
					  dataType: "json",
					  success: function (response){ 
						  success = response;
						  alert("Account deleted successful");
					  },
					  error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.status+"\n"+thrownError);
					  }	
					});
					
					if(success!=null){
						sessionStorage.removeItem("userConnected");			
						window.open("index.html","_self");
					}
				}
			}else{
				var pContent="The passwords do not match";
				$("#message").html(pContent);				
			}
		}
		
		this.loadUserFriends= function(){
			var outPutdata= new Array();
			this.friendsArray= new Array();
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=13&userID='+this.user.getUserID(), 
				  dataType: "json", 
				  success: function (response) { 
					  outPutdata = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});
			
			if(outPutdata[0]){
				for (var i = 0; i < outPutdata[1].length; i++){							
					this.friend= new friendsObj();
					this.friend.construct(outPutdata[1][i].userID, outPutdata[1][i].friendID);											
				}
				
				for (var i = 0; i < outPutdata[2].length; i++){							
					var user= new userObj();
					user.construct(outPutdata[2][i].userID, outPutdata[2][i].userType, outPutdata[2][i].userName, outPutdata[2][i].password, 
								   outPutdata[2][i].email, outPutdata[2][i].registerDate, outPutdata[2][i].unsubscribeDate, outPutdata[2][i].image, 
								   outPutdata[2][i].provinceID);
					this.friendsArray.push(user);											
				}								
			}else $("#friendsErrorMessage").html("Still don't have any added friends");
			
			var outPutdata= new Array();
			this.provincesArray= new Array();
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=14', 
				  dataType: "json", 
				  success: function (response) { 
					  outPutdata = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});
			
			if(outPutdata[0]){
				for (var i = 0; i < outPutdata[1].length; i++){							
					var province= new provinceObj();
					province.construct(outPutdata[1][i].provinceID, outPutdata[1][i].name, outPutdata[1][i].regionID);
					this.provincesArray.push(province);													
				}								
			}else showErrors(outPutdata[1]);	
		}
		
		this.deleteFriend= function(friendToDelete){
			var friendToDel;
			for (var i = 0; i < this.friend.length; i++){
				if(this.friend[i].getUserID()==this.friendsArray[friendToDelete].userID){
					friendToDel=this.friend[i];
				}
			}
			
			var success;
			$.ajax({
				url: 'php/control/control.php',  
				type: 'POST',  
				async: true,   
				data: 'action=15&friendToDelete='+JSON.stringify(friendToDel),
				dataType: "json", 
				success: function (response) { 
				    success = response;
				},
				error: function (xhr, ajaxOptions, thrownError){
					alert("There has been and error while connecting to server");
					console.log(xhr.status+"\n"+thrownError);
				}	
			});
			if(success) alert("Friend deleted correctly");
		}	
			
		this.checkWarnings= function(){
			var outPutdata= new Array();
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=10&userID='+this.user.getUserID(), 
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
				$("#warningAlert").fadeIn(200);		
				for (var i = 0; i < outPutdata[1].length; i++){
					if(outPutdata[1][i].read==0){
						this.warningsUser = new warningUsersObj();
						this.warningsUser.construct(outPutdata[1][i].warningID, outPutdata[1][i].userID, outPutdata[1][i].read);	
						this.warningsArray.push(this.warningsUser);	
					}else $("#warningAlert").hide();													
				}	
				
				var outPutdata= new Array();								
				$.ajax({
					  url: 'php/control/control.php',  
					  type: 'POST',  
					  async: false,   
					  data: 'action=11', 
					  dataType: "json", 
					  success: function (response) { 
						  outPutdata = response;
					  },
					  error: function (xhr, ajaxOptions, thrownError){
							alert("There has been and error while connecting to server");
							console.log(xhr.status+"\n"+thrownError);
					  }	
				});	
				
				if(outPutdata[0]){
					for (var i = 0; i < this.warningsArray.length; i++){
						for (var j = 0; j < outPutdata[1].length; j++){
							if((outPutdata[1][j].warningID==this.warningsArray[i].getWarningID())){								
								this.warnings= new warningObj();
								this.warnings.construct(outPutdata[1][j].warningID, outPutdata[1][j].description);
								this.warningsToShowArray.push(this.warnings);								
							}							
						}												
					}					
				}	
			}else $("#warningAlert").hide();
			var divContent="";
			for (var i = 0; i < this.warningsToShowArray.length; i++){
				divContent +=(i+1)+".- "+this.warningsToShowArray[i].description+"<br />";
			}
			$("#warningsDiv").html(divContent);					
		}
		
		this.readUserWarnings= function(){
			for (var i = 0; i < this.warningsArray.length; i++){
				this.warningsArray[i].setRead(1);
			}
			this.warningsArray = angular.copy(this.warningsArray);	
			var success;								
			$.ajax({
				  url: 'php/control/control.php',  
				  type: 'POST',  
				  async: false,   
				  data: 'action=12&warningsArray='+JSON.stringify(this.warningsArray), 
				  dataType: "json", 
				  success: function (response){ 
					  success = response;
				  },
				  error: function (xhr, ajaxOptions, thrownError){
						alert("There has been and error while connecting to server");
						console.log(xhr.status+"\n"+thrownError);
				  }	
			});	
		}		
		
	});
	
	//Templates of the application
	swapYourMusicApp.directive("userItemsManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/user-items-management.html",
		  controller:function(){
			
		  },
		  controllerAs: 'userItemsManagement'
		};
	});
	
	swapYourMusicApp.directive("userItemsModification", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/user-items-modification.html",
		  controller:function(){
			
		  },
		  controllerAs: 'userItemsModification'
		};
	});
	
	swapYourMusicApp.directive("homeSearchForm", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/home-search-form.html",
		  controller:function(){
			
		  },
		  controllerAs: 'homeSearchForm'
		};
	});
	
	swapYourMusicApp.directive("friendsListForm", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/friends-list-form.html",
		  controller:function(){
			
		  },
		  controllerAs: 'friendsListForm'
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



function filesManagementToModItems(itemToMod){
	//Remove image
	var imagesNameArray=new Array();
	imagesNameArray.push(itemToMod.getImage());
	$.ajax({
		url : 'php/control/controlFiles.php',
        type : 'POST',
        async: false,
        data : 'action=2&JSONData='+JSON.stringify(imagesNameArray),
        dataType: "json",
        success : function(response){
                   
        },
        error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status+"\n"+thrownError);
		}                
    });
    
	
	//Upload image
	var imageFiles = new FormData();
	
	var image = $("#imageMod")[0].files[0];
		
	imageFiles.append('images[]',image);
	
	var serverFileNames = new Array();
	itemToMod = angular.copy(itemToMod);
	
	$.ajax({
		url : 'php/control/controlFiles.php?action=1&titleItem='+$("#titleMod").val()+'&userID='+itemToMod.getUserID(),
        type : 'POST',
        async: false,
        data : imageFiles,
        dataType: "json",
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
