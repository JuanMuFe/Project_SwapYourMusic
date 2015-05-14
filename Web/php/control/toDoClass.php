<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/

require_once "../model/userClass.php";
require_once "../model/itemClass.php";
require_once "../model/genreClass.php";
require_once "../model/conditionClass.php";
require_once "../model/regionClass.php";
require_once "../model/itemClass.php";
require_once "../model/provinceClass.php";
require_once "../model/warningClass.php";
require_once "../model/warningUsersClass.php";
require_once "../model/bidClass.php";
require_once "../model/bidsParticipationClass.php";

	class toDoClass {
/*
 *@name: userConnection
 *@author: Juan Antonio Muñoz
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function userConnection($action, $JSONData){
			$userObj = json_decode(stripslashes($JSONData));

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userList = userClass::findByUserNameAndPass($userObj->userName, $userObj->password);
			
			if (count($userList)==0){
				$outPutData[0]=false;
				$errors[]="No user has found with these data";
				$outPutData[1]=$errors;
			}else{
				$usersArray=array();
				
				foreach ($userList as $user){
					$usersArray[]=$user->getAll();
				}				
				$outPutData[1]=$usersArray;
			}
			
			return json_encode($outPutData);
		}
		

		public function searchItemsByUser($action, $userID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listItemsSearch = itemClass::findByUserId($userID);
			
			if (count($listItemsSearch)==0)
			{
				$outPutData[0]=false;
				$errors[]="No items have been found into the databse";
				$outPutData[1]=$errors;
			}
			else
			{
				$itemsArray= array();
				foreach ($listItemsSearch as $item){
					$itemsArray[]=$item->getAll();
				}				
				
				$outPutData[1]=$itemsArray;
			}
		}
/*
 *@name: findByUserName
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchByUserName($action, $JSONData){
			$userObj = json_decode(stripslashes($JSONData));

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userList = userClass::findByUserName($userObj->userName);
			
			if (count($userList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$usersArray=array();
				
				foreach ($userList as $user){
					$usersArray[]=$user->getAll();
				}				
				$outPutData[1]=$usersArray;
			}
			
			return json_encode($outPutData);
		}
	
	
/*
 *@name: searchByEmail
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchByEmail($action, $JSONData){
			$userObj = json_decode(stripslashes($JSONData));

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userList = userClass::findByEmail($userObj->email);
			
			if (count($userList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$usersArray=array();
				
				foreach ($userList as $user){
					$usersArray[]=$user->getAll();
				}				
				$outPutData[1]=$usersArray;
			}
			
			return json_encode($outPutData);
		}
	
/*
 *@name: searchRegions
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchRegions($action){

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$regionsList = regionClass::findAll();
			
			if (count($regionsList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$regionsArray=array();
				
				foreach ($regionsList as $region){
					 $regionsArray[]=$region->getAll();
				}				
				$outPutData[1]=$regionsArray;
			}
			
			return json_encode($outPutData);
		}
		

		public function searchGenres($action){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listGenresSearch = genreClass::findAll();
			
			if (count($listGenresSearch)==0){
				$outPutData[0]=false;
				$errors[]="No genres have been found into the databse";
				$outPutData[1]=$errors;
			}else{
				$genresArray= array();
				
				foreach ($listGenresSearch as $genre){
					$genresArray[]=$genre->getAll();
				}				
				
				$outPutData[1]=$genresArray;
			}
		}

/*
 *@name: searchProvincesByRegion
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchProvincesByRegion($action, $regionID){

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$regionList = provinceClass::findByRegionID($regionID);
			
			if (count($regionList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$regionsArray=array();
				
				foreach ($regionList as $region){
					$regionsArray[]=$region->getAll();
				}				
				$outPutData[1]=$regionsArray;
			}
			
			return json_encode($outPutData);
		}
		
/*
 *@name: insertUser
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function insertUser($action, $JSONData){

			$userObj = json_decode(stripslashes($JSONData));
		
			$user = new userClass();	   	
			$user->setAll($userObj->userID ,$userObj->userType, $userObj->userName,$userObj->password,$userObj->email, $userObj->registerDate,$userObj->unsubscribeDate,$userObj->image, $userObj->provinceID);		
			
			//the senetnce returns de id of the user inserted
			echo json_encode($user->create());	
		}
		
		
		
/*
 *@name: searchClientUsersNameLike
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchClientUsersNameLike ($action, $userName){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userClientsList = userClass::findClientLikeUserName($userName);
			
			if (count($userClientsList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$userClientsArray=array();
				$userProvincesArray = array();
				
				foreach ($userClientsList as $user){
					 $userClientsArray[]=$user->getAll();
					 $userProvince=provinceClass::findById($user->getProvinceID());
					 foreach ($userProvince as $province){
						$userProvincesArray[]=$province->getAll();
					}
				}	
							
				$outPutData[1]=$userClientsArray;
				$outPutData[2]=$userProvincesArray;

			}
			
			return json_encode($outPutData);
		}
		
/*
 *@name: searchClientUsersByRegion
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchClientUsersByRegion ($action, $regionID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$provincesList = provinceClass::findProvincesByRegion($regionID);
			$userClientsList = userClass::findClientUsers();

				$userClientsArray=array();
				$userProvincesArray = array();
				
				foreach ($userClientsList as $user){
					 $user->getAll();					
					foreach ($provincesList as $province){
												
						if (strcmp($user->getProvinceID(),$province->getProvinceID())==0){
							$userClientsArray[] = $user->getAll();
							$userProvince=provinceClass::findById($user->getProvinceID());							
							foreach ($userProvince as $province){								
								$userProvincesArray[]=$province->getAll();
							}
						}
					}
				}								
				$outPutData[1]=$userClientsArray;
				$outPutData[2]=$userProvincesArray;
				
				if(count($userClientsArray)==0){
					$outPutData[0]=false;
					$outPutData[1]=$errors;	
					$outPutData[2]=$errors;	
				}
			
			return json_encode($outPutData);
		}

/*
 *@name: searchClientUsersByRegionLikeName
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchClientUsersByRegionLikeName ($action, $regionID, $userName){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$provincesList = provinceClass::findProvincesByRegion($regionID);
			$userClientsList = userClass::findClientLikeUserName($userName);

				$userClientsArray=array();
				$userProvincesArray = array();
				
				foreach ($userClientsList as $user){
					 $user->getAll();					
					foreach ($provincesList as $province){
						
						if (strcmp($user->getProvinceID(),$province->getProvinceID())==0){
							$userClientsArray[] = $user->getAll();
							$userProvince=provinceClass::findById($user->getProvinceID());							
							foreach ($userProvince as $province){								
								$userProvincesArray[]=$province->getAll();
							}
						}
					}
				}								
				$outPutData[1]=$userClientsArray;
				$outPutData[2]=$userProvincesArray;
				
				if(count($userClientsArray)==0){
					$outPutData[0]=false;
					$outPutData[1]=$errors;	
					$outPutData[2]=$errors;	
				}
			
			return json_encode($outPutData);
		}		

		

		public function searchConditions($action){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listConditionsSearch = conditionClass::findAll();
			
			if (count($listConditionsSearch)==0){
				$outPutData[0]=false;
				$errors[]="No conditions have been found into the databse";
				$outPutData[1]=$errors;
			}else{
				$conditionsArray= array();
				
				foreach ($listConditionsSearch as $condition){
					$conditionsArray[]=$condition->getAll();
				}				
				
				$outPutData[1]=$conditionsArray;
			}
		}

/*
 *@name: searchProvinces
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchProvinces($action){

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$provincesList = provinceClass::findAll();
			
			if (count($provincesList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$provincesArray=array();
				
				foreach ($provincesList as $province){
					 $provincesArray[]=$province->getAll();
				}				
				$outPutData[1]=$provincesArray;

			}
			
			return json_encode($outPutData);
		}
		

		public function insertItem($action, $JSONData){
			$itemObject = json_decode(stripslashes($JSONData));
			
			$item = new itemClass();
			$item->setAll($itemObject->itemID, $itemObject->userID, $itemObject->itemType, $itemObject->title, $itemObject->artist,
							$itemObject->releaseYear,$itemObject->genreID, $itemObject->conditionID, $itemObject->image, $itemObject->available);
			$item->create();				
			echo true;
		}
		
		public function modifyItem($action, $JSONData){
			$itemObject= json_decode(stripslashes($JSONData));
			$item= new itemClass();
			
			$item->setAll($itemObject->itemID, $itemObject->userID, $itemObject->itemType, $itemObject->title, $itemObject->artist,
							$itemObject->releaseYear,$itemObject->genreID, $itemObject->conditionID, $itemObject->image, $itemObject->available);
			$item->update();				
			echo true;
		}
	

/*
 *@name: deleteUser
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: true
 *
*/
		public function deleteUser($action, $JSONData){

			$userObj = json_decode(stripslashes($JSONData));
		
			$user = new userClass();	   	
			$user->setAll($userObj->userID ,$userObj->userType, $userObj->userName,$userObj->password,$userObj->email, $userObj->registerDate,$userObj->unsubscribeDate,$userObj->image, $userObj->provinceID);		
			$user->delete();
			
			echo true;
		}
		
/*
 *@name: modifyUser
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: true
 *
*/
		public function modifyUser($action, $JSONData){

			$userObj = json_decode(stripslashes($JSONData));
		
			$user = new userClass();	   	
			$user->setAll($userObj->userID ,$userObj->userType, $userObj->userName,md5($userObj->password),$userObj->email, $userObj->registerDate,$userObj->unsubscribeDate,$userObj->image, $userObj->provinceID);		
			$user->update();
			
			echo true;
		}



/*
 *@name: searchWarnings
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/11
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchWarnings(){

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$warningsList = warningClass::findActives();
			
			if (count($warningsList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$warningsArray=array();
				
				foreach ($warningsList as $warning){
					 $warningsArray[]=$warning->getAll();
				}				
				$outPutData[1]=$warningsArray;
			}
			
			return json_encode($outPutData);
		}
		
/*
 *@name: insertWarningToUser
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function inserts a new sent warning
 *@date: 2015/05/11
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function insertWarningToUser($warningID, $userID){
		
			$userWarning = new warningUsersClass();	   	
			$userWarning->setAll($warningID, $userID,0);		

			echo json_encode($userWarning->create());	
		}
		
		
/*
 *@name: insertWarning
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function inserts  warning
 *@date: 2015/05/11
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function insertWarning($JSONData){

			$warningObj = json_decode(stripslashes($JSONData));
		
			$warning = new warningClass();	   	
			$warning->setAll($warningObj->warningID ,$warningObj->description,$warningObj->active );		

			echo json_encode($warning->create());	
		}
		
/*
 *@name: setWarningInactive
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function inserts  warning
 *@date: 2015/05/11
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function setWarningInactive($JSONData){

			$warningObj = json_decode(stripslashes($JSONData));
		
			$warning = new warningClass();	 
			$warning->setAll($warningObj->warningID ,$warningObj->description,$warningObj->active);  	
			$warning->setInactive();
			
			echo true;	
			

		}
		
/*
 *@name: modifyWarning
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: true
 *
*/
		public function modifyWarning($JSONData){

			$warningObj = json_decode(stripslashes($JSONData));
		
			$warning = new warningClass();	   	
			$warning->setAll($warningObj->warningID ,$warningObj->description,$warningObj->active);  	
			$warning->update();
			
			echo true;
		}
		
/*
 *@name: searchBids
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchBids($nameToSearch){

			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;

			$userList = userClass::findClientLikeUserName($nameToSearch);
			
			
			if (count($userList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$bidsArray=array();
				$itemsArray = array();
				$usersArray = array();
				
				foreach ($userList as $user){
						$usersArray[]=$user->getAll();
						$itemList = itemClass::findByUserId($user->g);
					}
				
				
				
				
				
				foreach ($bidsList as $bid){
					 $bidsArray[]=$bid->getAll();
					 $itemList = itemClass::findById($bid->getItemID());
					 foreach ($itemList as $item){
						$itemsArray[]=$item->getAll();
						$userList = userClass::findById($item->getUserID());
						foreach ($userList as $user){
						$usersArray[]=$user->getAll();
						}
					}
				}				
				$outPutData[1]=$bidsArray;
				$outPutData[2]=$itemsArray;
				$outPutData[3]=$usersArray;
			}
			
			return json_encode($outPutData);
		}	
		
/*
 *@name: searchBidHistory
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action, $JSONData
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchBidHistory($bidID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$bidHistoryList = bidsParticipationClass::findByBidID($bidID);
			
			if (count($bidHistoryList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$bidHistoryArray=array();
				$usersArray = array();
				
				foreach ($bidHistoryList as $bidHistory){
					$bidHistoryArray[]=$bidHistory->getAll();
					
					$usersList = userClass::findById($bidHistory->getUserID());
					foreach ($usersList as $user){
						$usersArray[]=$user->getAll();
					}
					
				}				
				$outPutData[1]=$bidHistoryArray;
				$outPutData[2]=$usersArray;
			}
			
			return json_encode($outPutData);
		}	
		
/*
 *@name: searchClientUsersNameLike
 *@author: Irene Blanco Fabregat
 *@version: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchWarningsByUser ($userID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userWarningsList = warningUsersClass::findByUserId($userID);
			
			if (count($userWarningsList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$userWarningsArray=array();
				$warningsArray = array();
				
				foreach ($userWarningsList as $userWarning){
					 $userWarningsArray[]=$userWarning->getAll();
					 
					 $warningsList=warningClass::findById($userWarning->getWarningID());
					 foreach ($warningsList as $warning){
						$warningsArray[]=$warning->getAll();
					}
				}	
							
				$outPutData[1]=$userWarningsArray;
				$outPutData[2]=$warningsArray;

			}
			
			return json_encode($outPutData);
		}
		

}	
?>
