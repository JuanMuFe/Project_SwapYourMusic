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
							$newFileName = stripAccents($nameFile).".".$extension;
							move_uploaded_file($_FILES['images']['tmp_name'][$key], '../../img/items/' . $newFileName);
							
							$newFileNames[]='img/items/'.$newFileName;
						}
					}				
					
					echo json_encode($newFileNames);
					break;
					
			case 2:
					//This option is to remove files from the server
					$filesToDeleteArray = json_decode(stripslashes($_REQUEST["JSONData"]));
					
					foreach($filesToDeleteArray as $filename){
						unlink('../../'.$filename);
					}
					
					echo true;
					break;
			
			case 3:
					
					break;
			
			default: echo "Action not correct: ".$_REQUEST["action"];
					 break;
	}
	
	function stripAccents($string){
        $string = utf8_decode($string);
        $originals  = 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
        $modified = 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
        $result = utf8_encode(strtolower(strtr($string,utf8_decode($originals), $modified)));
        return $result;
    }
?>
