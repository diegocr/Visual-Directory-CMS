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

?>
<?php

/**
 * Visual Directory CMS
 * Copyright(C)2011 Diego Casorran <dcasorran[at]gmail.com>
 * All Rights Reserved.
 * 
 */

require('core.php');
// ini_set('display_errors',1);
// error_reporting(E_ALL);

$grpid = isset($_REQUEST['g']) ? intval($_REQUEST['g']) : 0;
$catid = isset($_REQUEST['c']) ? intval($_REQUEST['c']) : 0;

$smarty->assign('grpid',$grpid,true);
$smarty->assign('catid',$catid,true);

if(($leftmenuitems = intval($leftmenuitems)) < 1)
	$leftmenuitems = 16;

if(($leftmenuorder = intval($leftmenuorder)) < 1)
	$leftmenuorder = 0;

switch($leftmenuorder) {
	case 1:
		$leftmenuorder = 'id';
		break;
	case 0:
	default:
		$leftmenuorder = 'name';
		break;
}

$groups = $db->FetchRowSet("SELECT * FROM ! WHERE name <> 'Forsiden' ORDER BY ".$leftmenuorder." LIMIT ".$leftmenuitems,'%_groups');
foreach($groups as $k=>&$v) {
	$v['link'] = $v['id'] . '-' . $stuff->SeoString($v['name']) . '.html';
}
$smarty->assign('groups',$groups);

$smarty->assign('selgroup',$selgroup=$grpid ? $db->GetFirst("SELECT name FROM ! WHERE id = ?",array('%_groups',$grpid)):'Forsiden');
$smarty->assign('selcat',$catid ? $db->GetFirst("SELECT name FROM ! WHERE id = ?",array('%_categories',$catid)):'');

if($grpid) {
	// $cats = $db->FetchRowSet("SELECT * FROM ! WHERE grpid = ? AND name NOT IN ('',?) ORDER BY name",array('%_categories',$grpid,$selgroup));
	$cats = $db->FetchRowSet("SELECT c.*, g.name as gname, g.id as gid FROM ! c, ! g WHERE c.grpid = g.id AND c.grpid = ? AND c.name NOT IN ('',?) ORDER BY c.name",array('%_categories','%_groups',$grpid,$selgroup));
	foreach($cats as $k=>&$v) {
		$v['link'] = $v['gid'] . '-' . $stuff->SeoString($v['gname']) . '-' . $v['id'] . '-' . $stuff->SeoString($v['name']) . '.html';
	}
	$smarty->assign('categories',$cats);
	
	if( $catid < 1 ) {
		$mgcid = (int)$db->GetFirst("SELECT id FROM ! WHERE grpid = ? AND name IN (?,'')",array('%_categories',$grpid,$selgroup));
		if($mgcid)$catid = $mgcid;
	}
	
	if( $catid ) {
		
		if(($seodata = $db->GetOne("SELECT * FROM ! WHERE catid = ?",array('%_seo',$catid)))) {
			if(!empty($seodata['title']))$smarty->assign('title',$seodata['title']);
			if(!empty($seodata['mdesc']))$smarty->assign('description',$seodata['mdesc']);
			if(!empty($seodata['mkeys']))$smarty->assign('metakeys',$seodata['mkeys']);
		}
		
		$smarty->assign('links',$db->FetchRowSet("SELECT * FROM ! WHERE grpid = ? AND catid = ? ORDER BY title LIMIT 20",array('%_list',$grpid,$catid)));
	} else {
		$smarty->assign('links',$db->FetchRowSet("SELECT * FROM ! WHERE grpid = ? ORDER BY title LIMIT 20",array('%_list',$grpid)));
	}
} else {
	$homeid = (int)$db->GetFirst("SELECT id FROM ! WHERE name IN ('Forsiden','Home')",'%_groups');
	$smarty->assign('links',$db->FetchRowSet("SELECT * FROM !".($homeid?" WHERE grpid = '$homeid'":"")." ORDER BY title LIMIT 20",'%_list'));
}

$smarty->display('index.tpl');

?>