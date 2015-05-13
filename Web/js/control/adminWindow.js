//Angular Code
(function(){
	var swapYourMusicApp = angular.module("swapYourMusicApp", ["ng-currency"]);
	
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
		
		this.allWarningsArray = new Array();
		this.selectedWarning = 1;
		this.warning = new warningObj();
		this.description;
		
		this.allBidsArray = new Array();
		this.bidsHistoryArray = new Array();
		
		this.itemsArray = new Array();
		this.item = new itemObj();
	
		$scope.usersFlag = 0;
		$scope.flag;
		$scope.userAction=2;
		
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
			$scope.userAction=2;
	
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
			if($scope.userAction==2) {
				var confirmModify = confirm("Are you sure that you want to modify this user?");
				var action = 57;
			}
			else {
				var confirmAdd = confirm("Are you sure that you want to add this user?");
				var action = 54;
			}
			
			if(confirmModify || confirmAdd){
				this.user=angular.copy(this.user);

				if($scope.userAction==2) {
					var imageUserMod = $("#imageUserMod")[0].files[0];
					
					if(imageUserMod != undefined)
					{
						var imagesNameArray = userImagesManagement(this.user.getUserName(), this.user.getImage());
						this.user.setImage(imagesNameArray[0]);	
					}
				}	
				else{
					var imagesNameArray = imagesManagement(this.user.getUserName());
					this.user.setImage(imagesNameArray[0]);

				}		
							
				var error = false;
				
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action='+action+'&JSONData='+JSON.stringify(this.user),
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
					if($scope.userAction==2) alert("User correctly modified!");	
					else alert("User correctly added!");	
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
		
/*
 *@name: prepareRegister
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.prepareRegister = function(){

				this.user= new userObj();
				$scope.passControl="";
				this.user.setUnsubscribeDate("0000-00-00");
				this.user.setUserType(1);
				this.user.setUserID(0);
		}

/*
 *@name: warnings
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function defines the user and
 * shows a pop up to send the warning 
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.warnings = function(index){
				$scope.usersFlag = 2;
				this.user = this.usersArray[index];				
		}
		
/*
 *@name: sendWarning
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This functionsends the selected warning to the user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.sendWarning = function(){
			
			var error = false;
				
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=61&warningID='+this.selectedWarning+'&userID='+this.user.getUserID(),
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
					alert("The warning has been sent.")
					$scope.usersFlag = 0;
					this.loadWarnings();
					
				}
			}
						
		
/*
 *@name: loadWarnings
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.loadWarnings = function(){
			
			this.allWarningsArray = new Array();
			var outPutData= new Array();
						
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=60',
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
					var warning = new warningObj();
					warning.construct(outPutData[1][i].warningID, outPutData[1][i].description, outPutData[1][i].active);					
					this.allWarningsArray.push(warning);
				}			
					
			}				
				
				
		}
		
/*
 *@name: changeFlag
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function defines the user and
 * shows a pop up to send the warning 
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.changeFlag = function(index){
				$scope.usersFlag = 3;			
				$scope.userAction = 1;	
				this.warning = this.allWarningsArray[index];					
				this.description = this.warning.getDescription();					
		}
		
/*
 *@name: clearWarning
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function restarts the warning Object
 * shows a pop up to send the warning 
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.clearWarning = function(index){
				this.warning = new warningObj();					
				
		}
/*
 *@name: addWarning
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.warningsManagement = function(action){
			if(action==62){
				var confirmAdd = confirm("Do you really want to add this new warning message?");
				this.warning.setWarningID(0);
				this.warning.setActive(1);
			}
			else if(action==64){
				var modifyAdd = confirm("Do you really want to modify this  warning message?");
				this.warning.setDescription(this.description);
			}
			
			if(confirmAdd || modifyAdd){
				var error = false;
				
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action='+action+'&JSONData='+JSON.stringify(this.warning),
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
					alert("Warning succesfully added!");	
					$scope.usersFlag=0;	
					this.warning = new warningObj;
					this.loadWarnings();
					//location.reload();
					
				}
			}else this.warning = new warningObj();						
		}

		
/*
 *@name: deleteWarning
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.deleteWarning = function(index){
			var confirmDelete = confirm("Do you really want to delete the warning message?");
			this.warning = this.allWarningsArray[index];


			if(confirmDelete){
				var error = false;
				
				$.ajax({
					  url: 'php/control/control.php',
					  type: 'POST',
					  async: false,
					  data: 'action=63&JSONData='+JSON.stringify(this.warning),
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
					alert("Warning succesfully deleted!");	
					$scope.usersFlag=0;	
					this.warning = new warningObj;
					this.loadWarnings();
					
				}
			}else this.warning = new warningObj();				
		}
		
/*
 *@name: loadBids
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: this function controls loads all the regions
 *@date: 2015/05/05
 *@params: none
 *@return: none
*/
		this.loadBids = function(){
			var outPutData= new Array();
			
			this.allBidsArray = new Array();
						
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=65',
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
					var bid = new bidObj();
					bid.construct(outPutData[1][i].bidID, outPutData[1][i].itemID, outPutData[1][i].startPrice, outPutData[1][i].actualPrice, outPutData[1][i].duration, outPutData[1][i].startDate, outPutData[1][i].finishDate);					
					this.allBidsArray.push(bid);
				}
							
				for (var i = 0; i < outPutData[2].length; i++)
				{
					var item = new itemObj();
					item.construct(outPutData[2][i].itemID, outPutData[2][i].userID, outPutData[2][i].bidID, outPutData[2][i].itemType, outPutData[2][i].title, outPutData[2][i].artist, outPutData[2][i].releaseYear, outPutData[2][i].genreID, outPutData[2][i].conditionID, outPutData[2][i].image, outPutData[2][i].available, outPutData[2][i].uploadDate);
					this.itemsArray.push(item);
				}	
			}			
		}
		
/*
 *@name: showStory
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/			
		this.showHistory = function(index){

			$scope.usersFlag=4;
			this.bidsHistoryArray = new Array();
			
			//loading all the movements on the selected bid
			var bidIDToSearch = this.allBidsArray[index].getBidID();
			
			var outPutData= new Array();
						
			$.ajax({
				  url: 'php/control/control.php',
				  type: 'POST',
				  async: false,
				  data: 'action=66&bidID='+bidIDToSearch,
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
					var bidParticipation = new bidsParticipationObj();
					bidParticipation.construct(outPutData[1][i].userID, outPutData[1][i].bidID, outPutData[1][i].offeredMoney);					
					this.bidsHistoryArray.push(bidParticipation);
				}	
				
				for (var i = 0; i < outPutData[2].length; i++)
				{
					var user = new userObj();
						user.construct(outPutData[2][i].userID, outPutData[2][i].userType, outPutData[2][i].userName, outPutData[2][i].password,
										outPutData[2][i].email, outPutData[1][i].registerDate, outPutData[2][i].unsubscribeDate, outPutData[2][i].image,
										outPutData[2][i].provinceID);		
						
					this.usersArray.push(user);					
				}				
					
			}			

		}
/*
 *@name: showItemInfo
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/				
		this.showItemInfo = function(index){
			$scope.usersFlag = 5;
			this.item = this.itemsArray[index];
		}
/*
 *@name: hideItemInfo
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: This function modifies the selected user
 *@date: 2015/05/11
 *@params: none
 *@return: none
 *
*/				
		this.hideItemInfo = function(){
			$scope.usersFlag = 0;
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
	
	swapYourMusicApp.directive("warningsAdminSending", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/warnings-admin-sending.html",
		  controller:function(){

		  },
		  controllerAs: 'warningsAdminSending'
		};
	});
	
	swapYourMusicApp.directive("warningsAdminManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/warnings-admin-management.html",
		  controller:function(){

		  },
		  controllerAs: 'warningsAdminManagement'
		};
	});
	
	swapYourMusicApp.directive("bidsAdminManagement", function (){
		return {
		  restrict: 'E',
		  templateUrl:"templates/bids-admin-management.html",
		  controller:function(){

		  },
		  controllerAs: 'bidsAdminManagement'
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


 



