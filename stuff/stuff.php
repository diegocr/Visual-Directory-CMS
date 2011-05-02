<?php
/* ***** BEGIN LICENSE BLOCK *****
 * Version: MIT/X11 License
 * 
 * Copyright (c) 2011 Diego Casorran
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 * Contributor(s):
 *   Diego Casorran <dcasorran@gmail.com> (Original Author)
 * 
 * ***** END LICENSE BLOCK ***** */

?><?php

/**
 * Visual Directory CMS
 * Copyright(C)2011 Diego Casorran <dcasorran[at]gmail.com>
 * All Rights Reserved.
 * 
 */

class VdStuff {

	private $basedir;
	private $csconv;
	
	public function __construct($basedir) {
		
		$this->basedir = $basedir;
		$this->csconv = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
			'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
			'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
			'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
			'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
			'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
		);
	}
	
	public function __destruct() {
		
	}
	
	public function SeoString($string) {
		$string = strtr($string,$this->csconv);
		$string = trim($string);
		$string = strtolower($string);
		$string = str_replace('&', 'and', $string);
		$string = preg_replace('/[^a-z0-9_-]+/', '-', $string);
		$string = preg_replace('/[_-]+/', "-", $string);
		$string = preg_replace('/^-+|-+$/','', $string);
		return $string;
	}
	
	/* public function CKEditor($name='data',$contents = '') {
		@include_once($this->basedir.'/ckeditor/ckeditor.php');
		
		if(!class_exists('CKEditor'))
			die('Editor is missing, please warn the admin');
		
		$oCKeditor = new CKeditor('ckeditor/');
		$oCKeditor->returnOutput = true;
		$oCKeditor->config['toolbar'] = array(
			array('Source','-','Print', 'SpellChecker', 'Scayt'),
			array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
			array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
			'/',
			array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
			array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
			array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
			array('Link','Unlink','Anchor'),
			'/',
			array('Styles','Format','Font','FontSize'),
			array('TextColor','BGColor'),
			array('Maximize', 'ShowBlocks')
		);
		
		return $oCKeditor->editor($name,$contents);
	} */
	
	public function CreateDir($path)
	{
		if(is_dir($this->basedir.'/'.$path))
			return true;
		
		@mkdir( $this->basedir.'/'.$path, 0777, true);
		
		$paths = explode('/',$path);
		
		$old_path = '';
		foreach( $paths as $npath )
		{
			if(empty($npath))
				continue;
			
			$next_path = $old_path . $npath . '/';
			touch($this->basedir.'/'.$next_path.'index.html');
			chmod($this->basedir.'/'.$next_path.'index.html',0644);
			$old_path = $next_path;
		}
		
		unset($paths);
		
		return !!is_dir($this->basedir.'/'.$path);
	}
	
	public static function CalcPropScaling(&$width,&$height,$maxWidth,$maxHeight = 10000)
	{
		$width     = floatval($width);
		$height    = floatval($height);
		$maxWidth  = floatval($maxWidth);
		$maxHeight = floatval($maxHeight);
		$ratio     = MIN( $maxWidth / $width, $maxHeight/ $height );
		$width     = $ratio * $width;
		$height    = $ratio * $height;
		$result    = $width * $height;
		$width     = intval($width);
		$height    = intval($height);
		return $result;
	}
	
	/*public function UnsharpMask($img, $amount, $radius, $threshold) {
		
		//////////////////////////////////////////////////////////////
		////
		////		Unsharp Mask for PHP - version 2.1.1
		////
		////	Unsharp mask algorithm by Torstein H�nsi 2003-07.
		////			 thoensi_at_netcom_dot_no.
		////			   Please leave this notice.
		////http://vikjavev.no/computing/ump.php
		//////////////////////////////////////////////////////////////
		
		// $img is an image that is already created within php using
		// imgcreatetruecolor. No url! $img must be a truecolor image.
	
		// Attempt to calibrate the parameters to Photoshop:
		if ($amount > 500)	$amount = 500;
		$amount = $amount * 0.016;
		if ($radius > 50)	$radius = 50;
		$radius = $radius * 2;
		if ($threshold > 255)	$threshold = 255;
		
		$radius = abs(round($radius));	 // Only integers make sense.
		if ($radius == 0) {
			return $img; imagedestroy($img); break;		}
		$w = imagesx($img); $h = imagesy($img);
		$imgCanvas = imagecreatetruecolor($w, $h);
		$imgBlur = imagecreatetruecolor($w, $h);
		
		// Gaussian blur matrix:
		//						
		//	1	2	1		
		//	2	4	2		
		//	1	2	1		
		//						
		//////////////////////////////////////////////
		if (function_exists('imageconvolution')) { // PHP >= 5.1
			$matrix = array(
				array( 1, 2, 1 ),
				array( 2, 4, 2 ),
				array( 1, 2, 1 )
			);
			imagecopy ($imgBlur, $img, 0, 0, 0, 0, $w, $h);
			imageconvolution($imgBlur, $matrix, 16, 0);
		}
		else {
		
		// Move copies of the image around one pixel at the time and merge them with weight
		// according to the matrix. The same matrix is simply repeated for higher radii.
			for ($i = 0; $i < $radius; $i++)	{
				imagecopy ($imgBlur, $img, 0, 0, 1, 0, $w - 1, $h); // left
				imagecopymerge ($imgBlur, $img, 1, 0, 0, 0, $w, $h, 50); // right
				imagecopymerge ($imgBlur, $img, 0, 0, 0, 0, $w, $h, 50); // center
				imagecopy ($imgCanvas, $imgBlur, 0, 0, 0, 0, $w, $h);
	
				imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 33.33333 ); // up
				imagecopymerge ($imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 25); // down
			}
		}
	
		if($threshold>0){
			// Calculate the difference between the blurred pixels and the original
			// and set the pixels
			for ($x = 0; $x < $w-1; $x++)	{ // each row
				for ($y = 0; $y < $h; $y++)	{ // each pixel
						
					$rgbOrig = ImageColorAt($img, $x, $y);
					$rOrig = (($rgbOrig >> 16) & 0xFF);
					$gOrig = (($rgbOrig >> 8) & 0xFF);
					$bOrig = ($rgbOrig & 0xFF);
					
					$rgbBlur = ImageColorAt($imgBlur, $x, $y);
					
					$rBlur = (($rgbBlur >> 16) & 0xFF);
					$gBlur = (($rgbBlur >> 8) & 0xFF);
					$bBlur = ($rgbBlur & 0xFF);
					
					// When the masked pixels differ less from the original
					// than the threshold specifies, they are set to their original value.
					$rNew = (abs($rOrig - $rBlur) >= $threshold)
						? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig))
						: $rOrig;
					$gNew = (abs($gOrig - $gBlur) >= $threshold)
						? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig))
						: $gOrig;
					$bNew = (abs($bOrig - $bBlur) >= $threshold)
						? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig))
						: $bOrig;
					
					if (($rOrig != $rNew) || ($gOrig != $gNew) || ($bOrig != $bNew)) {
						$pixCol = ImageColorAllocate($img, $rNew, $gNew, $bNew);
						ImageSetPixel($img, $x, $y, $pixCol);
					}
				}
			}
		} else {
			for ($x = 0; $x < $w; $x++)	{ // each row
				for ($y = 0; $y < $h; $y++)	{ // each pixel
					$rgbOrig = ImageColorAt($img, $x, $y);
					$rOrig = (($rgbOrig >> 16) & 0xFF);
					$gOrig = (($rgbOrig >> 8) & 0xFF);
					$bOrig = ($rgbOrig & 0xFF);
					
					$rgbBlur = ImageColorAt($imgBlur, $x, $y);
					
					$rBlur = (($rgbBlur >> 16) & 0xFF);
					$gBlur = (($rgbBlur >> 8) & 0xFF);
					$bBlur = ($rgbBlur & 0xFF);
					
					$rNew = ($amount * ($rOrig - $rBlur)) + $rOrig;
						if($rNew>255){$rNew=255;}
						elseif($rNew<0){$rNew=0;}
					$gNew = ($amount * ($gOrig - $gBlur)) + $gOrig;
						if($gNew>255){$gNew=255;}
						elseif($gNew<0){$gNew=0;}
					$bNew = ($amount * ($bOrig - $bBlur)) + $bOrig;
						if($bNew>255){$bNew=255;}
						elseif($bNew<0){$bNew=0;}
					$rgbNew = ($rNew << 16) + ($gNew <<8) + $bNew;
						ImageSetPixel($img, $x, $y, $rgbNew);
				}
			}
		}
		imagedestroy($imgCanvas);
		imagedestroy($imgBlur);
		return $img;
	}
	*/
	public function ResampleImage($filename,$props=null,&$SaveData=null)
	{
		$lst2=@getimagesize($filename);
		$image_width=$orig_width=$lst2[0];
		$image_height=$orig_height=$lst2[1];
		$image_format=$lst2[2];
		$file_size = @filesize($filename);
		
		$OutFMT = 0; /* JPEG */
		if($props !== null) {
			if(isset($props['max_width'])) {
				if(isset($props['NoARCorr'])) {
					$image_width = $image_height = intval($props['max_width']);
				} else if($image_width > intval($props['max_width'])) {
					self::CalcPropScaling($image_width,$image_height,intval($props['max_width']));
				}
			}
			if(isset($props['PNG']))
				$OutFMT = 1;
		}
		
		if( $SaveData !== null ) {
			$SaveData['format'] = $image_format;
			$SaveData['width']  = $image_width;
			$SaveData['height'] = $image_height;
		}
		
		if( $OutFMT == 1 && $image_format == 3 && $image_width == $orig_width && $image_height == $orig_height )
		{
			return true;
		}
		
		switch($image_format)
		{
			case 1:	$image = imagecreatefromgif  ($filename);	break;
			case 2:	$image = imagecreatefromjpeg ($filename);	break;
			case 3:	$image = imagecreatefrompng  ($filename);	break;
			default:$image = null;break;
		}
		
		if(!$image)
			return false;
		
		$result = false;
		if(($new_image = imagecreatetruecolor($image_width,$image_height)))
		{
			if( $OutFMT == 1 ) {
				
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
				imagealphablending($image, true);
				
				if(function_exists('imagecolorallocatealpha') /* && $image_format == 3 */) {
					$rgb = imagecolorsforindex($image, imagecolorat($image, 1, $lst2[1] - 1));
					$transparent = imagecolorallocatealpha($new_image, $rgb['red'], $rgb['green'], $rgb['blue'], $rgb['alpha']);
					// $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
					imagefilledrectangle($new_image, 0, 0, $image_width, $image_height, $transparent);
				}
			}
			
			if((imagecopyresampled($new_image, $image, 0, 0, 0, 0, $image_width, $image_height, $lst2[0], $lst2[1])))
			{
				$quality = 90;
				$filename2 = $filename . '.temp.' . ($OutFMT == 1 ? 'png':'jpg');
				
				// $sharpenMatrix = array(array(-1,-1,-1),array(-1,16,-1),array(-1,-1,-1));
				// imageconvolution($new_image, $sharpenMatrix, 8, 0);
		//		$new_image = self::UnsharpMask($new_image,80,0.6,3);
				
				if( $OutFMT == 1 ) {
					
					$result = !!imagepng($new_image,$filename2);
					
					if( $result ) {
						unlink($filename);
						$result = !!rename($filename2,$filename);
					}
					
				} else {
				
					do {
						$result = !!imagejpeg($new_image, $filename2, $quality);
						$quality -= 10;
						
					} while($result && filesize($filename2) > $file_size && $quality > 60);
					
					if( $result ) {
						
						if(filesize($filename2) > $file_size) {
							unlink($filename2);
						} else {
							unlink($filename);
							$result = !!rename($filename2,$filename);
						}
					}
				}
			}
			imagedestroy($new_image);
		}
		imagedestroy($image);
		
		return $result;
	}
	
	public function SaveImage(&$FILE_Memb,$DestPath,$props=null,$OldFile='') {
		
		if(!$this->CreateDir($DestPath))
			return false;
		
		$name = preg_replace('#[^a-zA-Z0-9_.-]+#','',str_replace(' ','_',$FILE_Memb["name"]));
		
		if(!move_uploaded_file($FILE_Memb["tmp_name"], $DestPath.'/-'.$name))
			return false;
		
		if(!$this->ResampleImage($DestPath.'/-'.$name,$props)) {
			@unlink($DestPath.'/-'.$name);
			return false;
		}
		
		if(!empty($OldFile))
			@unlink($OldFile);
		
		if(($p = strrpos($name2=$name,'.')) !== false)
			$name2 = substr($name2,0,$p);
		
		$name2 .= '.jpg';
		
		if(!rename($DestPath.'/-'.$name,$DestPath.'/'.$name2)) {
			@unlink($DestPath.'/-'.$name);
			return false;
		}
		
		$FILE_Memb["name"] = $name2;
		
		return true;
	}
	
	public function SaveVdLogo($memb,$id,$grpid = -1,$catid = -1) {
		
		$temp_logo = 'zzz_logo_temp'.mt_rand(1,1000).'.png';
		if(is_string($memb)) {
			
			$image = $this->fetch($memb);
			
			if(empty($image))
				return 'Error downloading Logo.';
			
			if(!file_put_contents($temp_logo,$image))
				return 'Error Saving Downloaded logo';
		} else {
			if(!move_uploaded_file($memb["tmp_name"],$temp_logo))
				return 'Error moving uploaded logo';
		}
		
		$props = array('max_width'=>96,'NoARCorr'=>1,'PNG'=>1);
		if(!$this->ResampleImage($temp_logo,$props)) {
			@unlink($temp_logo);
			return 'Error resampling logo';
		}
		
		if($grpid == -1)
			$grpid = intval($_POST['grpid']);
		if($catid == -1)
			$catid = intval($_POST['catid']);
		
		$folder = 'images/logos/'.$grpid.'/'.$catid;
		if(!$this->CreateDir($folder)) {
			@unlink($temp_logo);
			return 'Error creating '.$folder;
		}
		
		if(!rename($temp_logo,$folder.'/'.$id.'.png')) {
			@unlink($temp_logo);
			return 'Error Renaming Logo...';
		}
		
		return '';
	}
	
	public function Crawler_ClearName($name) {
		if(($p=strpos($name,'://')) !== false) {
			$name = substr($name,$p+3);
			if(($p=strpos($name,'/')) !== false)
				$name = substr($name,0,$p);
			$name = str_ireplace('www.','',$name);
		}
		$name = str_replace('-new','',$name);
		$name = str_replace('-',' ',$name);
		$name = preg_replace('#\s+#',' ',$name);
		$name = ucwords(trim($name));
		return $name;
	}
	public function Crawler() {
		
		@require(dirname(__FILE__).'/../crawler.php');
		global $db;
		
		$start = time();
		
		foreach($groups as $gname => $cats) {
			
			if(!is_array($cats))
				continue;
			
			$gname = $this->Crawler_ClearName($gname);
			
			$grpid = (int)$db->GetFirst("SELECT id FROM ! WHERE name = ?",array('%_groups',$gname));
			if($grpid < 1) {
				$db->Query("INSERT INTO ! (name) VALUES(?)",array('%_groups',$gname));
				$grpid = (int)$db->GetFirst("SELECT id FROM ! WHERE name = ?",array('%_groups',$gname));
				$grpid > 0 or die('sql error 1');
			}
			
			foreach($cats as $cname => $cdata) {
				
				$cname = $this->Crawler_ClearName($cname);
				
				$catid = (int)$db->GetFirst("SELECT id FROM ! WHERE name = ? AND grpid = ?",array('%_categories',$cname,$grpid));
				if($catid < 1) {
					if(!($db->Query("INSERT INTO ! (name,grpid) VALUES(?,?)",array('%_categories',$cname,$grpid))))
						die($db->ErrorStr());
					$catid = (int)$db->GetFirst("SELECT id FROM ! WHERE name = ? AND grpid = ?",array('%_categories',$cname,$grpid));
					$catid > 0 or die('sql error 2');
				}
				
				for($x = 0,$m = count($cdata[1]); $x < $m; ++$x ) {
					
					$title = $this->Crawler_ClearName($cdata[2][$x]);
					$link = trim($cdata[1][$x]);
					
					if(stripos($link,'kadaza.com') !== false)
						continue;
					
					echo "<br/>$gname/$cname/$title: ";
					
					$id = (int)$db->GetFirst("SELECT id FROM ! WHERE grpid=? AND catid=? AND title=? AND link=?",array('%_list',$grpid,$catid,$title,$link));
					if($id < 1) {
						
						if(!($db->Query("INSERT INTO ! (grpid,catid,title,link) VALUES(?,?,?,?)",array('%_list',$grpid,$catid,$title,$link))))
							$error = $db->ErrorStr();
						else {
							$id = (int)$db->GetFirst("SELECT id FROM ! WHERE grpid=? AND catid=? AND title=? AND link=?",array('%_list',$grpid,$catid,$title,$link));
							// $id > 0 or die('sql error 3');
							if($id < 1)
								$error = 'sql error 3 (URL Too long?)';
							else
								$error = $this->SaveVdLogo('http://www.kadaza.com'.$cdata[3][$x],$id,$grpid,$catid);
						}
						
						if(!empty($error)) {
							
							$db->Query("DELETE FROM ! WHERE id = ?",array('%_list',$id));
							
							echo '<big><b>'.$error.'</b></big>';
						} else {
							echo 'OK';
						}
					} else {
						echo '<em>Already in database</em>';
					}
					flush();
					
					// break;
				}
				
				// break;
			}
			
			// break;
		}
		
		echo '<br><br>Process Took: '.(time()-$start).'s';
	}
	
	public function fetch($url)
	{
		$response = '';
		if(function_exists('curl_init') AND ($c = curl_init($url)) != FALSE)
		{
			curl_setopt_array($c,array(
				CURLOPT_RETURNTRANSFER	=>true,
				CURLOPT_HEADER			=>false,
				CURLOPT_SSL_VERIFYPEER	=>false,
				CURLOPT_FOLLOWLOCATION	=>true,
				CURLOPT_ENCODING		=>"",
				CURLOPT_AUTOREFERER		=>true,
				CURLOPT_CONNECTTIMEOUT	=>6,
				CURLOPT_TIMEOUT			=>4,
				CURLOPT_MAXREDIRS		=>9,
			));
			$response = curl_exec($c);
			@curl_close($c);
		}
		else
		{
			$response = @file_get_contents($url);
		}
		
		return $response;
	}
	
	public function Tidy($data,$format='html',$body=1) {
		
		if(!function_exists('tidy_parse_string'))
			return $data;
		
		$TidyOptions = array('output-'.$format=>1,'wrap'=>0,'clean'=>1,'ascii-chars'=>1,'show-body-only'=>$body);
		
		return str_replace("\n",'',(string)tidy_parse_string($data,$TidyOptions));
	}
	
	public function RemoveDirectory($directory, $empty=false) {
		
		if(substr($directory,-1) == '/')
			$directory = substr($directory,0,-1);
		
		if(!is_dir($directory))
			return false;
		
        if(!($handle = opendir($directory)))
			return false;
		
		while(false != ($item = readdir($handle))) {
			
			if($item == '.' OR $item == '..')
				continue;
			
			$path = $directory.'/'.$item;
			if(is_dir($path)) {
				$this->RemoveDirectory($path);
			}else{
				unlink($path);
			}
		}
		closedir($handle);
        
		if($empty == false) {
			if(!rmdir($directory)) {
				return false;
			}
		}
		return true;
	}
}

?>