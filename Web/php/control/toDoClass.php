<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/

require_once "../model/userClass.php";
require_once "../model/itemClass.php";
require_once "../model/genreClass.php";
require_once "../model/conditionClass.php";
require_once "../model/warningUsersClass.php";
require_once "../model/warningClass.php";
require_once "../model/friendsClass.php";
require_once "../model/provinceClass.php";

	class toDoClass {
/*
 *@name: userConnection
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
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
			
			return json_encode($outPutData);
		}
		
		public function insertItem($action, $JSONData){
			$itemObject = json_decode(stripslashes($JSONData));
			
			$item = new itemClass();
			$item->setAll($itemObject->itemID, $itemObject->userID, $itemObject->itemType, $itemObject->title, $itemObject->artist,
							$itemObject->releaseYear,$itemObject->genreID, $itemObject->conditionID, $itemObject->image, $itemObject->available, $itemObject->uploadDate);
			$item->create();				
			echo true;
		}
		
		public function deleteItem($action, $JSONData){
			$itemObject= json_decode(stripslashes($JSONData));
			$item= new itemClass();
			
			$item->setAll($itemObject->itemID, $itemObject->userID, $itemObject->itemType, $itemObject->title, $itemObject->artist,
							$itemObject->releaseYear,$itemObject->genreID, $itemObject->conditionID, $itemObject->image, $itemObject->available, $itemObject->uploadDate);
			$item->delete();				
			echo true;
		}
		
		public function modifyItems($action, $JSONItemToMod){
			$itemArray = json_decode(stripslashes($JSONItemToMod));
			
			foreach($itemArray as $itemObject){
				$item = new itemClass();	   	    
				$item->setAll($itemObject->itemID, $itemObject->userID, $itemObject->bidID, $itemObject->itemType, $itemObject->title, $itemObject->artist,
								$itemObject->releaseYear,$itemObject->genreID, $itemObject->conditionID, $itemObject->image, $itemObject->available, $itemObject->uploadDate);
				$item->update();
			}		
			echo true;
		}
		
		public function modifyUser($action, $JSONData){
			$userObj = json_decode(stripslashes($JSONData));
		
			$user = new userClass();	   	
			$user->setAll($userObj->userID ,$userObj->userType, $userObj->userName, md5($userObj->password),$userObj->email, $userObj->registerDate,$userObj->unsubscribeDate,$userObj->image, $userObj->provinceID);		
			$user->update();
			
			echo true;
		}
		
		public function searchLimitedItems($action, $limitNumber){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listItemsSearch = itemClass::findAllWithLimit($limitNumber);
			
			if (count($listItemsSearch)==0){
				$outPutData[0]=false;
				$errors[]="No items have been found into the databse";
				$outPutData[1]=$errors;
			}
			else{
				$itemsArray= array();
				$usersArray= array();
				$listUsersSearch = userClass::findAll();
				
				foreach ($listItemsSearch as $item){
					if($item->getAvailable()==1){
						$itemsArray[]=$item->getAll();
						
						foreach($listUsersSearch as $user){
							if($user->getUserID()==$item->getUserID()){
								$usersArray[]=$user->getAll();	
							}
						}	
					}																						
				}			
				
				$outPutData[1]=$itemsArray;
				$outPutData[2]=$usersArray;					
			}
			
			return json_encode($outPutData);
		}
		
		public function searchItems($action, $itemType, $genreID, $artist){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listItemsSearch = array();
			
			if($itemType!="" and $genreID=="" and $artist=="") $listItemsSearch = itemClass::findByItemType( $itemType );
			if($itemType=="" and $genreID!="" and $artist=="") $listItemsSearch = itemClass::findByGenre( $genreID );
			if($itemType== "" and $genreID=="" and $artist!="") $listItemsSearch = itemClass::findlikeArtist( $artist );
			if($itemType!= "" and $genreID!="" and $artist=="") $listItemsSearch = itemClass::findByItemtypeAndGenre( $itemType, $genreID );
			if($itemType!= "" and $genreID=="" and $artist!="") $listItemsSearch = itemClass::findByItemTypeAndArtist( $itemType, $artist );
			
			if (count($listItemsSearch)==0){
				$outPutData[0]=false;
				$errors[]="No items have been found into the databse";
				$outPutData[1]=$errors;
			}
			else{
				$itemsArray=array();
				foreach ($listItemsSearch as $item){
					$itemsArray[]=$item->getAll();
				}
				$outPutData[1]=$itemsArray;
			}
			
			return json_encode($outPutData);
		}
		
		public function checkWarnings($action,$userID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listWarnings = warningUsersClass::findByUserId($userID);
			
			if (count($listWarnings)==0){
				$outPutData[0]=false;
				$errors[]="No warnings have been found to you";
				$outPutData[1]=$errors;
			}
			else{
				$warningsArray= array();
				foreach ($listWarnings as $warning){
					$warningsArray[]=$warning->getAll();
				}				
				
				$outPutData[1]=$warningsArray;
			}
			
			return json_encode($outPutData);
		}
		
		public function searchWarnings($action){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listWarnings = warningClass::findAll();
			
			if (count($listWarnings)==0){
				$outPutData[0]=false;
				$errors[]="No warnings have been found";
				$outPutData[1]=$errors;
			}
			else{
				$warningsArray= array();
				foreach ($listWarnings as $warning){
					$warningsArray[]=$warning->getAll();
				}				
				
				$outPutData[1]=$warningsArray;
			}
			
			return json_encode($outPutData);
		}
		
		public function modifyReadWarnings($action, $warningsArray){
			$userWarningsArray = json_decode(stripslashes($warningsArray));
			
			foreach($userWarningsArray as $warningObject){
				$userWarning= new warningUsersClass();
				$userWarning->setAll($warningObject->warningID, $warningObject->userID, $warningObject->read);
				$userWarning->updateRead(); 			
			}		
			echo true;
		}
		
		public function loadUserFriends($action, $userID){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listUserFriends = friendsClass::findByUserId($userID);
			
			if (count($listUserFriends)==0){
				$outPutData[0]=false;
				$errors[]="No friends have been found into the database for you";
				$outPutData[1]=$errors;
			}
			else{
				$friendsArray= array();
				$usersArray= array();				
				$listUsersSearch = userClass::findAll();
				
				foreach ($listUserFriends as $friend){
						$friendsArray[]=$friend->getAll();
						
						foreach($listUsersSearch as $user){
							if($user->getUserID()==$friend->getFriendID()){
								$usersArray[]=$user->getAll();	
							}
						}	
				}								
				
				$outPutData[1]=$friendsArray;
				$outPutData[2]=$usersArray;			
			}
			
			return json_encode($outPutData);
		}
		
		public function searchProvinces($action){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			$listProvinces = provinceClass::findAll();
			
			if (count($listProvinces)==0){
				$outPutData[0]=false;
				$errors[]="No provinces have been found into the databse";
				$outPutData[1]=$errors;
			}else{
				$provincesArray= array();
				
				foreach ($listProvinces as $province){
					$provincesArray[]=$province->getAll();
				}				
				
				$outPutData[1]=$provincesArray;
			}
			
			return json_encode($outPutData);
		}
		
		public function deleteFriend($action, $friendToDelete){
			$friendObj = json_decode(stripslashes($friendToDelete));
		
			$friend = new friendsClass();	   	
			$friend->setAll($friendObj->userID ,$friendObj->friendID);		
			$friend->delete();
			
			echo true;
		}
	}
	
?>
