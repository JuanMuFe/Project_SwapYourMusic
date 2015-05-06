<?php
	session_start();
	$newFileNames = array();
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
	}
?>
