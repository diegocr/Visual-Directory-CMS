<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 13:26:29
         compiled from ".\templates\admin_categories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165844d679ff590b8f8-68312134%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b05c9e72a6419cc831985346cb72a023efb298d1' => 
    array (
      0 => '.\\templates\\admin_categories.tpl',
      1 => 1298106036,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165844d679ff590b8f8-68312134',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_math')) include 'C:\xampp\htdocs\VD\smarty\plugins\function.math.php';
if (!is_callable('smarty_function_cycle')) include 'C:\xampp\htdocs\VD\smarty\plugins\function.cycle.php';
?><?php $_template = new Smarty_Internal_Template("admin_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<script type="text/javascript">
function EditName(en,enid,name,b)
{
	try {
		var elm = document.getElementById(en+enid);
		elm.innerHTML = '';
		
		var newNode = document.createElement('input');
		newNode.type = "text";
		newNode.size = "40";
		newNode.name = '~'+name+'~'+enid;
		newNode.value = name;
		elm.appendChild(newNode);
		newNode.focus();
		
		var elm = document.getElementById(b);
		
		if(elm.innerHTML == '') {
			var newNode = document.createElement('input');
			newNode.type = "submit";
		//	newNode.className = "formbutton";
			newNode.name = "savechgs";
			newNode.value = "Save Changes";
			elm.appendChild(newNode);
		}
		
	} catch(e) {alert(e);}
}
function checkAll(form,name,val){
	for( i=0 ; i < form.length ; i++) {
		if( form.elements[i].type == 'checkbox' && form.elements[i].name == name ) {
			form.elements[i].checked = val;
		}
	}
}
</script>


<div class="module_detail_inside top_margin_6px" style="width:40%;float:left;border-right:1px solid #888">
	<br/>
	<table cellspacing="2" cellpadding="2" width="100%">
	<tbody>
		<tr>
			<td style="padding-left; 5px;">
				<form action="admin.php" method="post">
				<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
				<input type="hidden" name="op" value="grpOp">
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				
			<?php if ((($tmp = @$_smarty_tpl->getVariable('groups')->value)===null||$tmp==='' ? 0 : $tmp)){?>
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="<?php echo $_smarty_tpl->getVariable('item')->value['name'];?>
" /></th >
					<th width="5%">ID</th>
					<th width="50%" align="center">Group Name</th>
					<th width="8%" align="center">Action</th>
				</tr>
				<?php $_smarty_tpl->tpl_vars["mcount"] = new Smarty_variable("0", null, null);?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<?php echo smarty_function_math(array('equation'=>($_smarty_tpl->getVariable('mcount')->value)."+1",'assign'=>"mcount"),$_smarty_tpl);?>

				<tr class="<?php echo smarty_function_cycle(array('values'=>"oddrow,evenrow"),$_smarty_tpl);?>
">
					<td width="5%" align="center">
						<input type="checkbox" name="delete[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" /></td>
					<td width="5%" align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
					<td width="50%" id="egn<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
					<td align="center" width="8%">
						<a href="javascript:EditName('egn',<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
','rspg');"><img alt="" src="http://cdn1.iconfinder.com/data/icons/silk2/page_white_edit.png" border="0" title="Edit Category Name" /></a>
					</td>
				</tr>
				<?php }} ?>
				<tr>
					<td colspan="5" align="left">
						<img src="images/arrow_ltr.png" alt="" />
						<input type="submit" class="formbutton" value="Delete Selected" name="groupaction"/>
						<span style="float:right" id="rspg"></span>
					</td>
				</tr>
			<?php }?>
				</table>
			</form>
			<br/>
			<hr noshade size="1">
			<form action="admin.php" method="post">
				<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
				<br/><br/>&nbsp;Add New Group:
				<input type="text" size="40" name="addgrp" value="" style="width:48%"/>
				<input type="submit" class="formbutton" value="Submit" />
			</form>
			</td>
		</tr>
	</tbody>
	</table>
	<br/>
</div>
<br/>


<?php if ((($tmp = @$_smarty_tpl->getVariable('groups')->value)===null||$tmp==='' ? 0 : $tmp)){?>
<div class="module_detail_inside top_margin_6px" style="width:58%;float:right">
	<table cellspacing="2" cellpadding="2" width="100%">
	<tbody>
		<tr>
			<td style="padding-left; 5px;">
				<form action="admin.php" method="post">
				<input type="hidden" name="op" value="catOp">
				<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">

			<?php if ($_smarty_tpl->getVariable('cats')->value){?>
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="<?php echo $_smarty_tpl->getVariable('item')->value['name'];?>
" /></th >
					<th width="5%">ID</th>
					<th width="20%" align="center">Group</th>
					<th width="50%" align="center">Category Name</th>
					<th width="8%" align="center">Action</th>
				</tr>
				<?php $_smarty_tpl->tpl_vars["mcount"] = new Smarty_variable("0", null, null);?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cats')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<?php echo smarty_function_math(array('equation'=>($_smarty_tpl->getVariable('mcount')->value)."+1",'assign'=>"mcount"),$_smarty_tpl);?>

				<tr class="<?php echo smarty_function_cycle(array('values'=>"oddrow,evenrow"),$_smarty_tpl);?>
">
					<td width="5%" align="center">
						<input type="checkbox" name="delete[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" /></td>
					<td width="5%" align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
					<td width="20%"><?php echo $_smarty_tpl->tpl_vars['item']->value['gname'];?>
</td>
					<td width="50%" id="ecn<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
					<td align="center" width="8%">
						<a href="javascript:EditName('ecn',<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
','rspc');"><img alt="" src="http://cdn1.iconfinder.com/data/icons/silk2/page_white_edit.png" border="0" title="Edit Category Name" /></a>
					</td>
				</tr>
				<?php }} ?>
				<tr>
					<td colspan="6" align="left">
						<img src="images/arrow_ltr.png" alt="" />
						<input type="submit" class="formbutton" value="Delete Selected" name="groupaction"/>
						<span style="float:right" id="rspc"></span>
					</td>
				</tr>
			<?php }?>
			</table>
			</form>
			<br/>
			<hr noshade size="1">
			<form action="admin.php" method="post">
				<input type="hidden" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value;?>
">
				<br/><br/>&nbsp;Add New Category:
				<input type="text" size="40" name="addcat" value="" style="width:30%"/>
				<select name="selGrp">
				<?php  $_smarty_tpl->tpl_vars['ig'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ig']->key => $_smarty_tpl->tpl_vars['ig']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['ig']->key;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['ig']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ig']->value['name'];?>
</option>
				<?php }} ?>
				</select>
				<input type="submit" class="formbutton" value="Submit" />
			</form>
			</td>
		</tr>
	</tbody>
	</table>
	<br/>
</div>
<br/>
<?php }?>

<div class="clear"></div>
