{* ***** BEGIN LICENSE BLOCK *****
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
 * ***** END LICENSE BLOCK ***** *}

{include file="admin_header.tpl"}
{strip}
{literal}
<style>
form label {
	font:italic 14px Georgia;
	width:100px;
	text-align:right;
	margin-right:8px;
}
form input[type=text], form input[type=password] {
	padding:1px;
	font:bold 12px Helvetica;
	background-color:#777 !important;
	clear:both;
	float:right;
	min-width: 200px;
}
form input[type=submit] {
	background-color:#fff;
	float:right;
	clear:both;
}
.isep {
	clear:both;
	height:10px;
}
.Form {
	margin-top:30px;
	vertical-align:top;
	background: -moz-linear-gradient(right, #116890, #1178A0);
	-moz-border-radius:10px;
	padding:8px;
	min-width: 350px;
	border:1px solid #335;
}
.Form h3 {
	font:bold 14px Arial;
	background: -moz-linear-gradient(right, #346890, #4478A0);
	margin-bottom:6px;
}
</style>
<script type="text/javascript">
function SwitchFormState(f,s){
  var e = f.elements;
  var i = e.length;
  while(i--) {
	e[i].disabled = s;
  }
}
function goEdit(usr) {
	SwitchFormState(document.edForm,false);
	usr = usr.split(':');
	document.edForm['adm_id'].value = usr[0];
	document.edForm['adm_name'].value = usr[1];
	document.edForm['adm_username'].value = usr[2];
	document.edForm['adm_email'].value = usr[3];
	try {
		document.edForm.parentNode.style.setProperty('border','1px solid #e00','important');
		setTimeout(function(){document.edForm.parentNode.style.setProperty('border','1px solid #335','important');},700);
	} catch(e){}
}
function goRemove(id,name) {
	
	if(confirm('Are you COMPLETELY Sure you want to ERASE "'+name+'" as Admin!?')) {
		
		window.location = 'admin.php?page=accs&action=remove&adm_id='+id;
	}
}
window.onload= function(){
  SwitchFormState(document.edForm,true);
}
</script>
{/literal}

{if $error_msg != ''}
	<div align="center" style="padding:4px;background-color:#e00;color:#444">
		{$error_msg}
	</div>
	<br>
{/if}
	
	<table border="0" cellpadding="2" cellspacing="2" align="center" width="100%">
		
		<tr bgcolor="#446"><th>Id</th><th>Name</th><th>Username</th><th>E-Mail</th><th>[Edit]</th><th>[Remove]</th></tr>
	
	{assign var="count" value="0"}
	{foreach $site_admins as $admin}
		
		{math equation="$count+1" assign="count"}
		
		{if $count % 2}
		<tr bgcolor="#346890">
		{else}
		<tr bgcolor="#4478A0">
		{/if}
		<td align="right">{$admin.admin_id}</td>
		<td align="center">{$admin.admin_name}</td>
		<td align="center">{$admin.admin_username}</td>
		<td align="center">{$admin.admin_email}</td>
		<td align="center"><a href="javascript:void(0)" onclick="goEdit('{$admin.admin_id}:{$admin.admin_name}:{$admin.admin_username}:{$admin.admin_email}')"><img src="http://cdn1.iconfinder.com/data/icons/silk2/page_white_edit.png"></a></td>
		<td align="center"><a href="javascript:void(0)" onclick="goRemove('{$admin.admin_id}','{$admin.admin_username}')"><img src="http://cdn1.iconfinder.com/data/icons/softwaredemo/PNG/16x16/DeleteRed.png"></a></td>
		</tr>
		
	{/foreach}
	
	</table>
	
	<div align="center" style="padding:32px">
		
		<div class="left Form">
			<h3>Add new Administrator</h3>
			<form action="admin.php" method="post" name="addForm">
				
				<input type="hidden" name="page" value="accs">
				<input type="hidden" name="action" value="add">
			<label for="name">Name:</label>
				<input type="text" id="name" name="adm_name" value="">
				<div class="isep"></div>
			<label for="username">Username:</label>
				<input type="text" id="username" name="adm_username" value="">
				<div class="isep"></div>
			<label for="password">Password:</label>
				<input type="password" id="password" name="adm_pwd" value="">
				<div class="isep"></div>
			<label for="password2">Re-Type Password:</label>
				<input type="password" id="password2" name="adm_pwd2" value="">
				<div class="isep"></div>
			<label for="email">E-Mail:</label>
				<input type="text" id="email" name="adm_email" value="">
				<div class="isep"></div>
				<div><input type="submit" value="Submit"></div>
				
			</form>
			
		</div>
		
		<div class="right">
		  <div class="right Form">
			<h3>Edit Administrator</h3>
			<form action="admin.php" method="post" name="edForm" disabled="true">
				
				<input type="hidden" name="page" value="accs">
				<input type="hidden" name="action" value="edit">
				<input type="hidden" name="adm_id" value="">
			<label for="name">Name:</label>
				<input type="text" id="name" name="adm_name" value="">
				<div class="isep"></div>
			<label for="username">Username:</label>
				<input type="text" id="username" name="adm_username" value="">
				<div class="isep"></div>
			<label for="email">E-Mail:</label>
				<input type="text" id="email" name="adm_email" value="">
				<div class="isep"></div>
				<div><input type="submit" value="Submit"></div>
				
			</form>
			
		  </div>
		  
		  <div class="clear"></div>
		  
		  <div style="padding-top:20px;font:italic 14px Georgia">
			
			<img src="http://cdn1.iconfinder.com/data/icons/49handdrawing/24x24/left.png" style="float:left;padding-right:8px">
			
			New admins will <b>not</b> have add/edit/remove privileges.
			
		  </div>
		</div>
		
		<div class="clear"></div>
		
		
	</div>


{/strip}
{include file="admin_footer.tpl"}
