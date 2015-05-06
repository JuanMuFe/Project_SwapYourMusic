<?php
/**
 * toDoClass class
 * it controls the hole server part of the application
*/

require_once "../model/userClass.php";
require_once "../model/regionClass.php";
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
		
/*
 *@name: findByUserName
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
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
 *@versio: 1.0
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
 *@versio: 1.0
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
		
/*
 *@name: searchProvincesByRegion
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
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
 *@versio: 1.0
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
 *@name: searchClientUsers
 *@author: Irene Blanco Fabregat
 *@versio: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: $action
 *@return: $outPutData -> array with all user data.
 *
*/
		public function searchClientUsers ($action){
			$outPutData = array();
			$errors = array();
			$outPutData[0]=true;
			
			$userClientsList = userClass::findClientUsers();
			
			if (count($userClientsList)==0){
				$outPutData[0]=false;
				$outPutData[1]=$errors;
			}else{
				$userClientsArray=array();
				
				foreach ($userClientsList as $user){
					 $userClientsArray[]=$user->getAll();
				}				
				$outPutData[1]=$userClientsArray;
			}
			
			return json_encode($outPutData);
		}
}
	
?>
