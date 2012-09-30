<?php
 
class FileHelper {
 
   var $image;
   var $image_type;
   
   const typeNews = "news";
   const typePressReview = "pressreview";
   const typeSlideshow = "slideshow";
   const typeArticle = "article";

   function getFileExtension($fileName)
   {
   		$parts=explode(".",$fileName);
   		return $parts[count($parts)-1];
   }
   
   function getPermittedFileTypes($type)
   {
	   	if ($type == FileHelper::typeNews) {
	   		return array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
	   	}
	   	elseif ($type == FileHelper::typeArticle) {
	   		return array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
	   	}
	   	elseif ($type == FileHelper::typePressReview) {
	   		return array('application/pdf');
	   	}
	   	elseif ($type == FileHelper::typeSlideshow) {
	   		return array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
	   	}
	   	else {
	   		throw new Exception("Upload type unknow : ".$type.". Can't determine allowed file types");
	   	}
   }
   
   function getFileType($fileName)
   {
	   	$ext = $this->getFileExtension($fileName);
	   	return $ext;
   }
   
   private function getSafeFilename($filename) {
	   	$filename = str_replace(" ","_",$filename);
	   	$filename = str_replace("'","_",$filename);
	   	$charset='utf-8';
	   	$filename = htmlentities($filename, ENT_NOQUOTES, $charset);
	   	$filename = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $filename);
	   	$filename = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $filename); // pour les ligatures e.g. '&oelig;'
	   	$filename = preg_replace('#&[^;]+;#', '', $filename); // supprime les autres caractères
	   	return $filename;
   } 
   
   function getFilename($type, $filename, $id) {
	   	if ($type == FileHelper::typeNews) {
	   		return $type."-".$id.".".$this->getFileExtension($filename);
	   	}
	   	if ($type == FileHelper::typeArticle) {
			return $this->getSafeFilename($filename);
	   	}
	   	elseif ($type == FileHelper::typePressReview) {
			return $this->getSafeFilename($filename);
	   	}
	   	elseif ($type == FileHelper::typeSlideshow) {
	   		return $type."-".$id.".".$this->getFileExtension($filename);
	   	}
	   	else {
	   		throw new Exception("Upload type unknow : ".$type.". Can't determine filename");
	   	}
   }
   
   function getUploadFolder($type) {
   		if ($type == FileHelper::typeNews) {
   			return "../content/news/";
   		}
   		elseif ($type == FileHelper::typePressReview) {
   			return "../content/pressreview/";
   		}
   		elseif ($type == FileHelper::typeSlideshow) {
   			return "../content/slideshow/";
   		}
   		elseif ($type == FileHelper::typeArticle) {
   			return "../content/articles/";
   		}
   		else {
   			throw new Exception("Upload type unknow : ".$type.". Can't determine destination folder");
   		}
   }
   
   function upload($type, $id, $fileArray) {
   		define ('MAX_FILE_SIZE', 1024 * 1000);
   		$permitted = $this->getPermittedFileTypes($type);
   		//var_dump($fileArray);
   		if ($fileArray['size'] == 0) {
   			throw new Exception("File empty !");
   		}
   		if ($fileArray['size'] > MAX_FILE_SIZE) {
   			throw new Exception("File too big for upload [max=".MAX_FILE_SIZE."] !");
   		}
   		/*if (!in_array($fileArray['type'], $permitted)) {
   			throw new Exception("File type not supported for this type of upload !");
   		} */  		   		
   		switch($fileArray['error']) {
   			case 0:
   				$file = $this->getFilename($type, $fileArray['name'], $id);
   				$filepath = $this->getUploadFolder($type) . $file;
   				$success = move_uploaded_file($fileArray['tmp_name'], $filepath);
   				if ($success) {
   					return $file;
   				} else {
   					throw new Exception("Error uploading !");
   				}
   				break;
   			case 3:
   			case 6:
   			case 7:
   			case 8:
   				throw new Exception("Error uploading !");
   				break;
   			case 4:
   				throw new Exception("No file selected for upload !");
   		}
   }
 
}
?>