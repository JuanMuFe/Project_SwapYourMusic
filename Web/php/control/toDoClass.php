<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/

require_once "../model/userClass.php";
require_once "../model/itemClass.php";
require_once "../model/genreClass.php";
require_once "../model/conditionClass.php";

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
	}
	
?>
