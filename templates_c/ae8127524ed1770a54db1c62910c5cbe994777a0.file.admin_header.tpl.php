<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 13:25:02
         compiled from ".\templates\admin_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212124d679f9e66a4c8-60724530%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae8127524ed1770a54db1c62910c5cbe994777a0' => 
    array (
      0 => '.\\templates\\admin_header.tpl',
      1 => 1298161290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212124d679f9e66a4c8-60724530',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<style>
body {
	background:#235;
	height: 100%;
	color:#eee;
	margin:0 auto;
}
.globalContainer {
	margin-top:12px;
}
.adm_con {
	width:960px;
	margin:0 auto;
}
.adm_content {
	width:956px;
	min-height:400px;
	margin:0 auto;
	-moz-border-radius:5px 20px 20px 20px;
	border-radius:40px 20px;
	border:1px solid #347;
	margin-top:18px;
	background-color:#34689A;
}
.adm_content_title {
	-moz-border-radius: 40px 20px 0 0;
	background: -moz-linear-gradient(left, #34689A, #4478AA);
	font: bold 16px Times New Roman;
	letter-spacing: 0.2em;
	padding-bottom: 6px;
	padding-right: 16px;
	padding-top: 8px;
	margin-bottom:12px;
}
.adm_content_container {
	width:96%;
	padding-bottom: 20px;
	margin:0 auto;
}
.adm_header {
	padding:16px;
	border:1px solid #457;
	background:#446 url(images/Blue_Gradient.jpg) no-repeat top left;
	font:italic 32px Georgia;
	-moz-border-radius-topleft:15px;
	-moz-border-radius-topright:15px;
}
.adm_header ul {
	border: none;
	margin: 0;
	padding: 0;
	list-style-type: none;
	clear: left;
	width:960px;
	background-color:#457;
}
.adm_header ul li {
//	display: block;
	float: left;
	padding: 0;
	margin: 0;
	border: none;
	display    : inline;
	position   : relative;
	z-index    : 1;
//	margin-right : 1px;
}
.adm_header ul li a {
	display: block;
//	height:40px;
	padding: 0;
	padding-right:22px;
	margin: 0;
	font:bold 12px Tahoma;
	color:#ccd;
}
.adm_header ul li a:hover {
	color:#fff;
}
select, textarea, .textinput, .passwordinput, input {
	background-color: #666;
	background: -moz-linear-gradient(top, #828282, #d2d2d2);
	background: -webkit-gradient(linear, left top, left bottom, from(#828282), to(#d2d2d2));
	filter:progid:DXImageTransform.Microsoft.Gradient(StartColorStr='#828282', EndColorStr='#d2d2d2');
	scroller-border: 1px solid #089365;
}
a:link, a:visited {
  color: #d2d2d2;
  text-decoration: none;
}
input:focus, textarea:focus, select:focus {
  border: 1px solid #fff;
  color: #333;
}
.column_head {
	background-color:#123456;
}
.oddrow {
	background-color:#668;
}
.evenrow {
	background-color:#458;
}
</style>
<div class="adm_con"><div class="adm_header"><div class="left" style="padding-top:30px">Admin Panel</div><div class="right"><img src="images/administrator.png"></div><div class="clear"></div><ul><li><a href="admin.php">Home</a></li><li><a href="admin.php?page=settings">Settings</a></li><li><a href="admin.php?page=accs">Admin Management</a></li><li><a href="admin.php?page=categories">Categories</a></li><li><a href="admin.php?page=links">Links</a></li><li><a href="admin.php?page=crawler">Crawler</a></li><li><a href="admin.php?page="></a></li><li style="float:right;padding-right:26px"><a href="admin.php?page=logout">Logout</a></li></ul></div><div class="adm_content"><div class="adm_content_title" align="right"><?php echo (($tmp = @$_smarty_tpl->getVariable('adm_title')->value)===null||$tmp==='' ? "Administration" : $tmp);?>
</div><div class="adm_content_container">
