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

require('core.php');

// Disable Smarty Cache
$smarty->caching = false;

if(!isset($_SESSION['admin'])) {
	
	$done = false;
	$error_msg = '';
	if(isset($_SESSION['admin_login_tries']) && intval($_SESSION['admin_login_tries']) < 1) {
		
		if((time()-intval($_SESSION['admin_login_lasttry'])) < 3600)
			die('Too many login tries...');
		
		$error_msg = 'You can now try to re-login....';
		unset($_SESSION['admin_login_tries']);
	}
	else if(isset($_POST['adm_user'])) {
		
		$key = intval(strtr($_POST['key'],'mKouYTgAQW','0123456789'));
		
		if((time()-$key) < 300) {
			
			if(empty($adm_user) OR empty($adm_pass)) {
				
				$error_msg = 'Required fields missing..';
			} else {
				
				if($security->ParamCheck(array('P'=>array('adm_user'=>'#^[a-z0-9]+$#i','adm_pass'=>'#^[^\'"()]+$#')))) {
					
					$adm_pass = md5(VD_SITEKEY.$adm_pass);
					$args = array('%_admin',$adm_user,$adm_pass);
					
					$this_adm = $db->GetOne('SELECT * FROM ! WHERE admin_username = ? AND admin_password = ?',$args);
					
					if(empty($this_adm) || strcmp($adm_user,$this_adm['admin_username']) || strcmp($adm_pass,$this_adm['admin_password'])) {
						
						if(!isset($_SESSION['admin_login_tries']))
							$_SESSION['admin_login_tries'] = 3;
						
						if(--$_SESSION['admin_login_tries'] < 1)
							$_SESSION['admin_login_lasttry'] = time();
						
						$error_msg = 'Invalid username/password.<br><b>You have '.($_SESSION['admin_login_tries']).' tries left...</b>';
						
					} else {
						
						$_SESSION['admin'] = $this_adm;
						$done = true;
					}
					unset($adm_pass,$args,$this_adm);
					
				} else {
					$error_msg = 'The data you filled in looks invalid...';
				}
			}
			
		} else {
			$error_msg = 'You took too long... please try again...';
		}
	}
	
	$smarty->assign('error_msg',$error_msg);
	
	if(!$done) {
		$smarty->assign('temp_key',strtr(time(),'0123456789','mKouYTgAQW'));
		$smarty->display('admin_login.tpl');
		exit;
	}
}

$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

if(isset($_SESSION['admin']['access_time'])) {
	
	if((time() - $_SESSION['admin']['access_time']) > 3600) {
		
		$page = 'logout';
	}
}
$_SESSION['admin']['access_time'] = time();
$smarty->assign('page',$page);

// $db->Query("ALTER TABLE vd_prefs MODIFY option_value VARCHAR(999)");

switch( $page ) {
	
	case 'settings':
		
		$template_files = array();
		if(($handle=opendir(dirname(__FILE__).'/templates')) !== false)
		{
			while(($file = readdir($handle)) !== false)
			{
				if( $file[0] == '.' || $file == 'footer.tpl' || substr($file,-3) != 'tpl' || substr($file,0,5) == 'admin' )
					continue;
				
				$template_files[] = $file;
			}
			closedir($handle);
		}
		$smarty->assign('template_files',$template_files);
		$smarty->assign('tplfile','');
		
		if(isset($_POST['cancel'])) {
		}
		else if(isset($_POST['savetpl']) && preg_match('#^[a-z_]+\.tpl$#',$_POST['tplfile'])) {
			// print_r($_POST);exit;
			
			// $tplfile_c = stripslashes(stripslashes($_POST['tplfile_c']));
			// Needed for eg js's unicode chars.. TODO: MaskHTMLTags()
			$tplfile_c = $_POST['tplfile_c'];
			$a1 = array("\\'", "\\\"", "\\\\", "\\0");
			$a2 = array("'", "\"", "\\", "");
			$tplfile_c = str_replace($a1,$a2,$tplfile_c);
			$tplfile_c = str_replace($a1,$a2,$tplfile_c);
			$tplfile = dirname(__FILE__).'/templates/'.$_POST['tplfile'];
			
			@unlink($tplfile.'-');
			rename($tplfile,$tplfile.'-');
			file_put_contents($tplfile,$tplfile_c);
		}
		else if(isset($_POST['tplfile']) && preg_match('#^[a-z_]+\.tpl$#',$_POST['tplfile'])) {
			
			$smarty->assign('tplfile',$_POST['tplfile'],true);
			$con = htmlentities(file_get_contents(dirname(__FILE__).'/templates/'.$_POST['tplfile']));
			// $smarty->assign('tplfile_c',$stuff->CKEditor('tplfile_c',$con));
			$smarty->assign('tplfile_c','<textarea rows="20" cols="144" name="tplfile_c" style="background-color:#111;background:#111;color:#eee">'.$con.'</textarea><br>');
		}
		else if(isset($_POST['saveset'])) {
			
			unset($_POST['saveset']);
			unset($_POST['page']);
			
			@move_uploaded_file($_FILES['logo']["tmp_name"], dirname(__FILE__).'/images/logo.png');
			$_POST['logo'] = 'images/logo.png';
			
			if(!$_FILES['background']['error']) {
				@move_uploaded_file($_FILES['background']["tmp_name"], dirname(__FILE__).'/images/background.png');
				$_POST['background'] = 'images/background.png';
			}
			
			foreach($_POST as $k=>$v) {
				
				$v = stripslashes(stripslashes($v));
				$db->Query('UPDATE ! SET option_value=? WHERE option_name=?',array('%_prefs',$v,$k));
				$$k = $v;
				$smarty->assign($k,$v);
			}
			
		} else if(empty($settings)) {
			$default_settings = array(
				'title'			=> 'Honningkrukka - Din nye nettportal',
				'description'	=> 'En startside som gjøin netthverdag enda enklere',
				'metakeys'		=> 'portal,nettportal,startside,søkemotor,søkemotorer',
				'template'		=> 'templates/',
				'logo'			=> 'images/logo.png',
				'background'	=> '',
				'leftmenuitems'	=> '16',
				'leftmenuorder'	=> '0',
				'rsbanner'		=> '',
			);
			
			foreach($default_settings as $k=>$v) {
				
				$db->Query("INSERT INTO ! (option_name,option_value) VALUES(?,?)",array('%_prefs',$k,$v));
				$$k = $v;
				$smarty->assign($k,$v);
			}
		}
		
		$smarty->assign('adm_title','Site Settings');
		$smarty->display('admin_settings.tpl');
		break;
	
	case 'accs':
		
		$error_msg = '';
		if(!empty($action)) {
			
			if(intval($_SESSION['admin']['admin_id']) != 1) {
				
				$error_msg = 'You are not allowed to perform this action.';
			}
			else if($action == 'remove' && $adm_id == intval($_SESSION['admin']['admin_id'])) {
				
				$error_msg = 'You cannot remove yourself...';
			}
			else {
				
				switch( $action ) {
					
					case 'remove':
						if(!($db->Query('DELETE FROM ! WHERE admin_id > 1 AND admin_id = ?',array('%_admin',intval($adm_id))))) {
							$msg = '';
							$err = $db->Error($msg);
							
							$error_msg = 'Error '.$err.': '.$msg;
						} else {
							header('Location: admin.php?page=accs');
							exit;
						}
						break;
					
					case 'add':
						if(empty($adm_pwd) OR strcmp($adm_pwd,$adm_pwd2) OR strlen($adm_pwd) < 3) {
							
							$error_msg = 'Invalid Password.';
						} else {
							
							if($security->ParamCheck(array('P'=>array('adm_username'=>'#^[a-z0-9]+$#i','adm_pwd'=>'#^[^\'"()]+$#','adm_email'=>'#^[a-z_.-]+@[a-z_.-]+\.[a-z]{2,5}$#i')))) {
								
								$admin_key = sha1($adm_username.time().$adm_pwd.$_SERVER['REMOTE_ADDR'].$adm_email);
								$args = array('%_admin',$adm_name,$admin_key,$adm_username,$adm_pwd,$adm_email);
								
								if(!($db->Query('INSERT INTO ! (admin_name,admin_key,admin_username,admin_password,admin_email) VALUE(?,?,?,?,?)',$args))) {
									$msg = '';
									$err = $db->Error($msg);
									
									$error_msg = 'Error '.$err.': '.$msg;
								}
								
							} else {
								$error_msg = 'The data you filled in looks invalid...';
							}
						}
						break;
					
					case 'edit':
						$args = array('%_admin',$adm_name,$adm_username,$adm_email,$adm_id);
						if(!($db->Query('UPDATE ! SET admin_name=?,admin_username=?,admin_email=? WHERE admin_id = ?',$args))) {
							$msg = '';
							$err = $db->Error($msg);
							
							$error_msg = 'Error '.$err.': '.$msg;
						}
						break;
					
					default:
						$error_msg = 'unknown action';
						break;
				}
			}
		}
		
		$site_admins = $db->FetchRowSet($db->Query('SELECT * FROM !','%_admin'));
		
		$smarty->assign('site_admins',$site_admins,true);
		unset($site_admins);
		
		$smarty->assign('error_msg',$error_msg,true);
		$smarty->assign('adm_title','Admins Management');
		
		$smarty->display('admin_manage.tpl');
		break;
	
	case 'crawler':
		$stuff->Crawler();
		break;
	
	case 'logout':
		session_destroy();
		header('Location: admin.php');
		break;
	
	case 'categories':
		
		if(isset($_POST['addgrp']))
		{
			$db->Query("INSERT INTO ! (name) VALUES(?)",array('%_groups',trim($_POST['addgrp'])));
		}
		else if(isset($_POST['addcat']))
		{
			$db->Query("INSERT INTO ! (name,grpid) VALUES(?,?)",array('%_categories',trim($_POST['addcat']),intval($_POST['selGrp'])));
		}
		else if(isset($_POST['savechgs']))
		{
			$ThisTable = $_POST['op'] == 'grpOp' ? '%_groups':'%_categories';
			
			foreach($_POST as $key=>$value)
			{
				if($key[0] != '~')
					continue;
				
				$key = explode('~',$key);
				
				$name = trim($key[1]);
				$id = intval($key[2]);//echo $id;exit;
				$value = trim($value);
				
				if($id < 1 OR !strcmp($name,$value))
					continue;
				
				$db->Query("UPDATE ! SET name=? WHERE id=?",array($ThisTable,$value,$id));
			}
		}
		else if(isset($_POST['delete']))
		{
			$posts_where = $_POST['op'] == 'grpOp' ? 'grpid':'catid';
			
			foreach($_POST['delete'] as $catid)
			{
				$catid = intval($catid);
				if($catid < 1)
					continue;
				
				$db->Query("DELETE FROM ! WHERE ".$posts_where."=?",array('%_list',$catid));
				
				if($_POST['op'] == 'grpOp') {
					$db->Query("DELETE FROM ! WHERE grpid=?",array('%_categories',$catid));
					$db->Query("DELETE FROM ! WHERE id=?",array('%_groups',$catid));
					
					$stuff->RemoveDirectory('images/logos/'.$catid);
					
				} else {
					$grpid = (int)$db->GetFirst("SELECT grpid FROM ! WHERE id = ?",array('%_categories',$catid));
					
					$db->Query("DELETE FROM ! WHERE id=?",array('%_categories',$catid));
					
					$stuff->RemoveDirectory('images/logos/'.$grpid.'/'.$catid);
				}
			}
		}
		
		$smarty->assign('groups',$db->FetchRowSet("SELECT * FROM ! ORDER BY name ASC",'%_groups'));
		// $cats = $this->GetCatWGroups();
		$cats = $db->FetchRowSet("SELECT c.*, g.name as gname FROM ! g, ! c WHERE (c.grpid = g.id) ORDER BY g.name,c.name",array('%_groups','%_categories'));
		$smarty->assign('cats',$cats);
		$smarty->assign('adm_title','Edit Categories');
		
		$smarty->display('admin_categories.tpl');
		break;
	
	case 'linkedit':
		
		$grpid = 0;
		$catid = 0;
		
		if(isset($_POST['saveseo'])) {
			
			$grpid = intval($_POST['grpid']);
			$catid = intval($_POST['catid']);
			
			foreach($_REQUEST as $key => &$value)
				$value = stripslashes(stripslashes(substr($value,0,254)));
			
			if(($seoid = intval($_REQUEST['seoid'])) < 1) {
				
				$db->Query("INSERT INTO ! (catid,title,mdesc,mkeys) VALUES(?,?,?,?)",array('%_seo',$_REQUEST['catid'],$_REQUEST['mtitle'],$_REQUEST['mdesc'],$_REQUEST['mkeys']));
				
			} else {
				
				$db->Query("UPDATE ! SET title=?,mdesc=?,mkeys=? WHERE id=?",array('%_seo',$_REQUEST['mtitle'],$_REQUEST['mdesc'],$_REQUEST['mkeys'],$seoid));
			}
			
		} else if(!isset($_POST['savelink'])) {
			
			$c = intval($_REQUEST['c']);
			
			$cats = $db->FetchRowSet("SELECT * FROM ! WHERE catid = ? ORDER BY title",array('%_list',$c));
			$smarty->assign('cats',$cats);
			
			if(($seodata = $db->GetOne("SELECT * FROM ! WHERE catid = ?",array('%_seo',$c)))) {
				
				$smarty->assign('seoid', $seodata['id']);
				$smarty->assign('mtitle',$seodata['title']);
				$smarty->assign('mdesc', $seodata['mdesc']);
				$smarty->assign('mkeys', $seodata['mkeys']);
			}
			$smarty->assign('grpid',(int)$db->GetFirst("SELECT grpid FROM ! WHERE id = ?",array('%_categories',$c)));
			$smarty->assign('catid',$c);
			$smarty->display('admin_linkedit.tpl');
			break;
		} else if(isset($_POST['deletelink'])) {
			
			$grpid = intval($_POST['grpid']);
			$catid = intval($_POST['catid']);
			$lnkid = intval($_POST['savelink']);
			
			$db->Query("DELETE FROM ! WHERE id = ?",array('%_list',$lnkid));
			
			unlink('images/logos/'.$grpid.'/'.$catid.'/'.$lnkid.'.png');
			
		} else {
			
			$linkedit_err = 1;
			$message = '';
			$sl = intval($_POST['savelink']);
			$grpid = intval($_POST['grpid']);
			$catid = intval($_POST['catid']);
			$title = ucfirst(trim($_POST['title']));
			$link = trim($_POST['link']);
			
			if($_FILES['logo']['error'] == UPLOAD_ERR_NO_FILE) {
				
				if(empty($_POST['logo_url'])) {
					
					$message = 'You have to supply a logo!';
				} else {
					
					$memb = $_POST['logo_url'];
					
				}
				
			} else if($_FILES['logo']['error']) {
				
				$message = 'Error uploading logo!';
				
			} else {
				
				$memb = $_FILES['logo'];
				
			}
			
			$skip_logo = !empty($message) AND $sl != -1;
			
			if(empty($title) OR empty($link)) {
				$message = 'Required fields missing!';
			}
			else if(empty($message) OR $skip_logo) {
				
				$message = '';
				if(strpos($link,'://') === false)
					$link = 'http://'.$link;
				
				if($sl == -1) {
					
					$data = array('%_list',$grpid,$catid,$title,$link);
					if(!($db->Query("INSERT INTO ! (grpid,catid,title,link) VALUES(?,?,?,?)",$data)))
						$message = $db->ErrStr();
					
				} else {
					
					$data = array('%_list',$title,$link,$sl);
					if(!($db->Query("UPDATE ! SET title=?,link=? WHERE id = ?",$data)))
						$message = $db->ErrStr();
				}
				
				if(empty($message)) {
					$data = array('%_list',$grpid,$catid,$_POST['title']);
					$id = $sl != -1 ? $sl : (int)$db->GetFirst("SELECT id FROM ! WHERE grpid=? AND catid=? AND title=? ORDER BY id DESC",$data);
					
					if(!$skip_logo)
						$message = $stuff->SaveVdLogo($memb,$id);
					
					if(empty($message)) {
						
						$message = $skip_logo ? 'Changes Saved Succesfully':'Logo Inserted Succesfully!';
						$linkedit_err = 0;
						
					} else {
						
						$db->Query("DELETE FROM ! WHERE id = ?",array('%_list',$id));
					}
				}
			}
			
			$smarty->assign('linkedit_err',$linkedit_err);
			$smarty->assign('message',$message);
			/* NO Break; Here */
		}
		
	case 'links':
		
		if($page == 'links') {
			$grpid = 0;
			$catid = 0;
			$smarty->assign('linkedit_err',0);
		}
		
		$allcats = $db->FetchRowSet("SELECT c.*, g.name as gname FROM ! g, ! c WHERE (c.grpid = g.id) ORDER BY g.name,c.name",array('%_groups','%_categories'));
		
		$groups = array();
		$group_ids = array();
		foreach($allcats as $row)
		{
			if(!isset($groups[$row['gname']]))
				$groups[$row['gname']] = array();
			
			$groups[$row['gname']][$row['name']] = intval($row['id']);
			$group_ids[intval($row['grpid'])] = $row['gname'];
		}
		$smarty->assign('json_groups',json_encode($groups));
		$smarty->assign('json_group_ids',json_encode($group_ids));
		
		$smarty->assign('sel_grpid',$grpid);
		$smarty->assign('sel_catid',$catid);
		
		$smarty->assign('adm_title','Edit Links');
		$smarty->display('admin_links.tpl');
		break;
	
	default:
		$smarty->display('admin_home.tpl');
		break;
}

exit;
?>