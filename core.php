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

define('IN_VDCORE',			true);
define('IN_VDCORE_LOCAL',	true);
// define('IN_VDCORE_DEBUG',	true);
define('VD_SITEKEY',		'IxYmY0$MDJjNzk1Zjkxg3bjd%mNTVhYT!liNDlkMjY5MD');

@ob_start();
if(extension_loaded('zlib')) {
	
	if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
		@ini_set("zlib.output_compression", '6');
	}
}
header('content-type: text/html; charset=UTF-8');

// Database connection setup
require('stuff/database.php');
!empty($db) or die('Cannot create database instance.');

// Site Settings
$settings = $db->FetchRowSet($db->Query('SELECT * FROM !','%_prefs'));

// SMARTY Setup
require('smarty/Smarty.class.php');
$smarty = new Smarty;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

// Globalice Settings
if(!empty($settings)) {
	foreach($settings as $k => $v) {
		if(!is_string($v['option_name']) OR empty($v['option_name']))
			continue;
		$smarty->assign($v['option_name'],$v['option_value'],true);
		${$v['option_name']} = $v['option_value'];
	}
}

// Register a session
session_start();

if(!isset($_SESSION['access_time']))
	$_SESSION['access_time'] = time();

$_SESSION['visit_time'] = time();

// Simple Security Measures
require('stuff/security.php');
$security = new Security(dirname(__FILE__));

// Common Routines
require('stuff/stuff.php');
$stuff = new VdStuff(dirname(__FILE__));

// Debugging?
if(defined('IN_VDCORE_DEBUG')) {
	error_reporting( E_ALL );
	ini_set('display_errors',1);
	$smarty->debugging = true;
	$smarty->caching = false;
} else {
	error_reporting(0);
	ini_set('display_errors',0);
	$smarty->debugging = false;
}

// Check admin availability
$adm = isset($_SESSION['admin']) ? $_SESSION['admin']
	: $db->GetOne('SELECT * FROM ! WHERE admin_id = ?', array('%_admin','1'));
$smarty->assign('footer_js','var dummy = "CMS Developed by Diego Casorran [dcasorran/at/gmail.com]";');
if(empty($adm)) {
	
	$done = false;
	$error_msg = '';
	$smarty->caching = false;
	if(isset($_REQUEST['key'])) {
		
		$key = intval(strtr($_POST['key'],'mKouYTgAQW','0123456789'));
		
		if((time()-$key) < 300) {
			
			if(empty($pwd) OR strcmp($pwd,$pwd2) OR strlen($pwd) < 3) {
				
				$error_msg = 'Invalid Password.';
			} else {
				
				if($security->ParamCheck(array('P'=>array('usr'=>'#^[a-z0-9]+$#i','pwd'=>'#^[^\'"()]+$#','mail'=>'#^[a-z_.-]+@[a-z_.-]+\.[a-z]{2,5}$#i')))) {
					
					define('IN_VD_ADMINSTALL', true);
					
					define('VD_ADMINSTALL_USERNAME',$usr);
					define('VD_ADMINSTALL_PASSWORD',md5(VD_SITEKEY.$pwd));
					define('VD_ADMINSTALL_ADMEMAIL',$mail);
					
					require('stuff/install.php');
					$done = true;
					
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
		$smarty->display('admin_welcome.tpl');
	} else {
		$smarty->display('admin_install.tpl');
	}
	
	exit;
}
$security->RegisterGlobals($adm);
unset($adm);

?>