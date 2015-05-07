<?php
	session_start();
	$newFileNames = array();
<<<<<<< HEAD
	switch ($_REQUEST["action"]){	
			case 1:	//option to upload item images to the server
					$nameFile=str_replace(" ","",$_REQUEST["titleItem"])."".$_REQUEST["userID"];
					foreach($_FILES['images']['error'] as $key => $error){
						if($error == UPLOAD_ERR_OK){							
							$name = $_FILES['images']['name'][$key];
							$fileNameParts = explode(".", $name);  
							$nameWithoutExtension = $fileNameParts[0];
							$extension = end($fileNameParts);
							$newFileName = $nameFile.".".$extension;
							move_uploaded_file($_FILES['images']['tmp_name'][$key], '../../img/items/' . $newFileName);
							
							$newFileNames[]='img/items/'.$newFileName;
						}
					}
					echo json_encode($newFileNames);
					break;
					
			case 2:
					break;
			
			default: echo "Action not correct: ".$_REQUEST["action"];
					 break;
=======
	switch ($_REQUEST["action"] )
    {
		case "50":
			//This option is to upload users images to the server
			//$_FILES contains all the file to upload
			//The program returns an array with the new file's name that ust be inserted into the database
			
			$userNamesArray = json_decode(stripslashes($_REQUEST["userNamesArray"]));
			$i=0;
			foreach($_FILES['images']['error'] as $key => $error){
				if($error == UPLOAD_ERR_OK){
					$name = $_FILES['images']['name'][$key];
					$fileNameParts = explode(".", $name);  
					$nameWithoutExtension = $fileNameParts[0];
					$extension = end($fileNameParts);
					$newFileName = $userNamesArray[$i].".".$extension;
					move_uploaded_file($_FILES['images']['tmp_name'][$key], '../../img/users/' . $newFileName);
					$i++;
					$newFileNames[]='img/users/'.$newFileName;
				}
			}
			echo json_encode($newFileNames);
			break;
		case "51":
			//This option is to remove files from the server
			//$_REQUEST["JSONData"] contains all the file's names to remove
			$filesToDeleteArray = json_decode(stripslashes($_REQUEST["JSONData"]));

			foreach($filesToDeleteArray as $filename){
				unlink('../../'.$filename);
			}
			
			echo true;
			break;
		default:
			echo "Action not correct: ".$_REQUEST["action"];
			break;
>>>>>>> bc61bf70b022cf299088ddfb413396cc50106a05
	}
?>
