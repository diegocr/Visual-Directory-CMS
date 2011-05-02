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

defined('IN_VD_ADMINSTALL') or die('Access Denied.');


if(!defined('VD_ADMINSTALL_USERNAME')
OR !defined('VD_ADMINSTALL_PASSWORD')
OR !defined('VD_ADMINSTALL_ADMEMAIL')) {
	die('Install error, missing data');
}

if(file_exists(dirname(__FILE__).'/install_lock.txt'))
	die('Installation process is locked, please contact your administrator..');

$sql_file = dirname(__FILE__).'/database.sql';

if(!file_exists($sql_file))
	die('Install error, missing database.sql');

$data = file_get_contents(dirname(__FILE__).'/database.sql');

if(!preg_match_all('#(CREATE.*?;\n|INSERT.*?\);\n)#si',$data,$qs))
	die('Install error, parsing database.sql');

$error_msg = '';
foreach($qs[1] as $q) {
	
	if(!($db->Query($q))) {
		$msg = '';
		$err = $db->Error($msg);
		
		$error_msg .= '<br><br>Error '.$err.' Executing "'.htmlentities(substr($q,0,62)).'...": '.$msg;
	}
}

$admin_key = sha1(VD_ADMINSTALL_USERNAME.time().VD_ADMINSTALL_PASSWORD.$_SERVER['REMOTE_ADDR'].VD_ADMINSTALL_ADMEMAIL);
$args = array('%_admin',VD_ADMINSTALL_USERNAME,$admin_key,VD_ADMINSTALL_USERNAME,VD_ADMINSTALL_PASSWORD,VD_ADMINSTALL_ADMEMAIL);

if(!($db->Query('INSERT INTO ! (admin_name,admin_key,admin_username,admin_password,admin_email) VALUE(?,?,?,?,?)',$args))) {
	$msg = '';
	$err = $db->Error($msg);
	
	$error_msg .= '<br><br>Error '.$err.' <b>INSERTING ADMIN:</b> '.$msg;
}
unset($args,$admin_key);

if(!empty($error_msg)) {
	
	touch(dirname(__FILE__).'/install_lock.txt');
}

?>