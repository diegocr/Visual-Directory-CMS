<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 13:25:23
         compiled from ".\templates\admin_linkedit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198194d679fb334d350-64012235%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '104aa453664bc253a822153f725208c52e4bb1d2' => 
    array (
      0 => '.\\templates\\admin_linkedit.tpl',
      1 => 1298105655,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198194d679fb334d350-64012235',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include 'C:\xampp\htdocs\VD\smarty\plugins\function.cycle.php';
?><style>
label {
	width:30px;
	display: block;
	float: left;
	font:bold 13px Tahoma;
	letter-spacing: 1px;
	padding-left: 2px;
}
form.le {
	margin:0 auto;
	padding:4px;
	font:12px/160% Helvetica;
	width: 328px;
	-moz-border-radius:5px;
	border:1px solid #123;
	background-color:#3c7ac1;
	overflow:hidden;
	margin-top:12px;
	margin-right:10px;
}
form.le input {
	font:bold 12px/140% Sans-serif,Helvetica;
	width:100%;
	overflow:hidden;
	color:#143677;
}
form.le input.aabh {
	width:280px;
	float:right;
}
form.le input[type=submit] {
	color:#eee;
}
.imu {
	background-color:#779;
	padding:4px 6px;
	margin-top:6px;
	clear:both;
}
.imu img {
	padding:0px;
	margin:0 auto;
}
.imu label {
	min-width:180px;
	font:12px Arial;
	padding-left:1px;
}
</style>

<?php if ($_smarty_tpl->getVariable('cats')->value!=''){?>
	
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cats')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
		<form class="le <?php echo smarty_function_cycle(array('values'=>"left,right"),$_smarty_tpl);?>
" action="admin.php" method="post" enctype="multipart/form-data">
			
			<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
			<input type="hidden" name="savelink" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
			<input type="hidden" name="catid" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['catid'];?>
">
			<input type="hidden" name="grpid" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['grpid'];?>
">
			
			<label for="title">Title:</label>
			<input class="aabh" type="text" name="title" id="title" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['title'])===null||$tmp==='' ? '' : $tmp);?>
">
			
			<br/><label for="title">Link:</label>
			<input class="aabh" type="text" name="link" id="link" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['link'])===null||$tmp==='' ? '' : $tmp);?>
">
			
			<div class="imu">
				<img style="float:right" alt="Current Logo" title="Current Logo" src="images/logos/<?php echo $_smarty_tpl->tpl_vars['item']->value['grpid'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['catid'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
.png" width="64" height="50" />
				<span style="float:left;width:200px;">
					<label for="logo">Update Logo From Disk:</label>
					<input type="file" name="logo" id="logo" value="">
				</span>
				
				<br/><label for="logo_url">or From an URL:</label>
				<input type="text" name="logo_url" id="logo_url" value="">
			</div>
			<div style="margin:0 auto">
				<input class="left" style="width:60%" type="submit" value="Save Changes"/>
				<input class="right" style="width:40%" type="submit" name="deletelink" value="Delete Link"/>
				<div class="clear"></div>
			</div>
		</form>
	<?php }} ?>
<?php }?>

		<br><form class="le right" action="admin.php" method="post" enctype="multipart/form-data">
			
			<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
			<input type="hidden" name="catid" value="<?php echo $_smarty_tpl->getVariable('catid')->value;?>
">
			<input type="hidden" name="grpid" value="<?php echo $_smarty_tpl->getVariable('grpid')->value;?>
">
			<input type="hidden" name="savelink" value="-1">
			
			<label for="title">Title:</label>
			<input type="text" name="title" id="title" value="">
			
			<br/><label for="title">Link:</label>
			<input type="text" name="link" id="link" value="">
			
			<br/><div class="imu">
				<span style="float:left;width:200px;">
					<label for="logo">Upload Logo From Disk:</label>
					<input type="file" name="logo" id="logo" value="">
				</span>
				<img style="float:right" alt="Current Logo" title="Current Logo" src="images/spacer.gif" width=64 height=64 />
				<span class="clear"></span>
				<br/><label for="logo_url">or From an URL:</label>
				<input type="text" name="logo_url" id="logo_url" value="">
			</div>
			<input type="submit" value="Submit New Link"/>
		</form>

		
		<div class="clear"></div>
		