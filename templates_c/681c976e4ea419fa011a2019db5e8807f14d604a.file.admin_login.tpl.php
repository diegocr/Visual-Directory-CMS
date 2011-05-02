<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 13:24:54
         compiled from ".\templates\admin_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:250064d679f96da5f23-79995661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '681c976e4ea419fa011a2019db5e8807f14d604a' => 
    array (
      0 => '.\\templates\\admin_login.tpl',
      1 => 1293891181,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '250064d679f96da5f23-79995661',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<style>
.con {
	background-color:#235;
	padding:80px;
	height: 100%;
	color:#eee;
	margin:0 auto;
}
.con h1 {
	font:italic 38px Georgia;
	margin-top:20px;
}
.box {
	width:400px;
	margin:0 auto;
	border:1px solid #9ac;
	-moz-border-radius:5px;
	padding:20px;
	background-color:#89a;
	color:#235;
	font:14px Arial;
	clear:both;
}
form label {
	font:italic 18px Georgia;
	width:100px;
}
form input[type=text], form input[type=password] {
	padding:3px;
	font:bold 16px Helvetica;
	background-color:#777 !important;
	clear:both;
	float:right;
}
form input[type=submit] {
	background-color:#fff;
}
.isep {
	clear:both;
	height:20px;
}
.box p {
	font:bold 14px Tahoma;
	text-align:center;
}
</style>
<div class="con"><img src="http://cdn1.iconfinder.com/data/icons/general13/png/128/administrator.png" align="right"><h1>Administration Access</h1><div class="box"><?php if ($_smarty_tpl->getVariable('error_msg')->value!=''){?><p style="background:#e00;color:#000"><?php echo $_smarty_tpl->getVariable('error_msg')->value;?>
</p><?php }else{ ?><p></p><?php }?><br><br><form action="admin.php" method="post"><input type="hidden" name="key" value="<?php echo $_smarty_tpl->getVariable('temp_key')->value;?>
"><label for="username">Username:</label><input type="text" id="username" name="adm_user" value=""><div class="isep"></div><label for="password">Password:</label><input type="password" id="password" name="adm_pass" value=""><div class="isep"></div><div><input type="submit" value="Submit"></div></form></div><br></div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
