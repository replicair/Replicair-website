<?php
include_once('FileHelper.php');

class ImageHelper extends FileHelper {
 
   var $image;
   var $image_type;

   /*function getFileExtension($fileName)
   {
   		$parts=explode(".",$fileName);
   		return $parts[count($parts)-1];
   }
   
   function upload($type, $id, $fileArray) {
   		define ('MAX_FILE_SIZE', 1024 * 1000);
   		$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
   		if ($fileArray['size'] == 0) {
   			throw new Exception("File empty !");
   		}
   		if ($fileArray['size'] > MAX_FILE_SIZE) {
   			throw new Exception("File too big for upload !");
   		}
   		if (!in_array($fileArray['type'], $permitted)) {
   			throw new Exception("File type not supported !");
   		}
   		
   		define('UPLOAD_DIR', '../img/news/');
   		
   		
   		switch($fileArray['error']) {
   			case 0:
   				$file = $type."-".$id.".".$this->getFileExtension($fileArray['name']);
   				$filepath = UPLOAD_DIR . $file;
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
   }*/
   
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   /* Old function, no transparency
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }*/
   function resize($width,$height) {
   	$new_image = imagecreatetruecolor($width, $height);
   	echo 'Image-type : ' . $this->image_type;
   	echo 'IMAGETYPE_GIF : ' . IMAGETYPE_GIF;
   	echo 'IMAGETYPE_PNG : ' . IMAGETYPE_PNG;
   	if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG ) {
   		echo 'In type for transparency : ' . $this->image_type;
   		$current_transparent = imagecolortransparent($this->image);
   		echo 'Current transparency : ' . $current_transparent;
   		if($current_transparent != -1) {
   			$transparent_color = imagecolorsforindex($this->image, $current_transparent);
   			$current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
   			imagefill($new_image, 0, 0, $current_transparent);
   			imagecolortransparent($new_image, $current_transparent);
   		} elseif( $this->image_type == IMAGETYPE_PNG) {
   			imagealphablending($new_image, false);
   			$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
   			imagefill($new_image, 0, 0, $color);
   			imagesavealpha($new_image, true);
   		}
   	}
   	imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
   	$this->image = $new_image;
   }
 
}
?>