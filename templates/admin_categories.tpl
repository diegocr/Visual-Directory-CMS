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
{literal}
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
{/literal}

<div class="module_detail_inside top_margin_6px" style="width:40%;float:left;border-right:1px solid #888">
	<br/>
	<table cellspacing="2" cellpadding="2" width="100%">
	<tbody>
		<tr>
			<td style="padding-left; 5px;">
				<form action="admin.php" method="post">
				<input type="hidden" name="page" value="{$page}">
				<input type="hidden" name="op" value="grpOp">
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				
			{if $groups|default:0}
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="{$item.name}" /></th >
					<th width="5%">ID</th>
					<th width="50%" align="center">Group Name</th>
					<th width="8%" align="center">Action</th>
				</tr>
				{assign var="mcount" value="0"}
				{foreach $groups as $item}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle  values="oddrow,evenrow"}">
					<td width="5%" align="center">
						<input type="checkbox" name="delete[]" value="{$item.id}" /></td>
					<td width="5%" align="center">{$item.id}</td>
					<td width="50%" id="egn{$item.id}">{$item.name}</td>
					<td align="center" width="8%">
						<a href="javascript:EditName('egn',{$item.id},'{$item.name}','rspg');"><img alt="" src="http://cdn1.iconfinder.com/data/icons/silk2/page_white_edit.png" border="0" title="Edit Category Name" /></a>
					</td>
				</tr>
				{/foreach}
				<tr>
					<td colspan="5" align="left">
						<img src="images/arrow_ltr.png" alt="" />
						<input type="submit" class="formbutton" value="Delete Selected" name="groupaction"/>
						<span style="float:right" id="rspg"></span>
					</td>
				</tr>
			{/if}
				</table>
			</form>
			<br/>
			<hr noshade size="1">
			<form action="admin.php" method="post">
				<input type="hidden" name="page" value="{$page}">
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


{if $groups|default:0}
<div class="module_detail_inside top_margin_6px" style="width:58%;float:right">
	<table cellspacing="2" cellpadding="2" width="100%">
	<tbody>
		<tr>
			<td style="padding-left; 5px;">
				<form action="admin.php" method="post">
				<input type="hidden" name="op" value="catOp">
				<input type="hidden" name="page" value="{$page}">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">

			{if $cats}
				<tr class="column_head">
					<th width="5%"><input type="checkbox" name="chkall" value="" onclick="checkAll(this.form,'delete[]',this.checked)" /><input type="hidden" name="act" value="{$item.name}" /></th >
					<th width="5%">ID</th>
					<th width="20%" align="center">Group</th>
					<th width="50%" align="center">Category Name</th>
					<th width="8%" align="center">Action</th>
				</tr>
				{assign var="mcount" value="0"}
				{foreach item=item key=key from=$cats}
				{math equation="$mcount+1" assign="mcount"}
				<tr class="{cycle  values="oddrow,evenrow"}">
					<td width="5%" align="center">
						<input type="checkbox" name="delete[]" value="{$item.id}" /></td>
					<td width="5%" align="center">{$item.id}</td>
					<td width="20%">{$item.gname}</td>
					<td width="50%" id="ecn{$item.id}">{$item.name}</td>
					<td align="center" width="8%">
						<a href="javascript:EditName('ecn',{$item.id},'{$item.name}','rspc');"><img alt="" src="http://cdn1.iconfinder.com/data/icons/silk2/page_white_edit.png" border="0" title="Edit Category Name" /></a>
					</td>
				</tr>
				{/foreach}
				<tr>
					<td colspan="6" align="left">
						<img src="images/arrow_ltr.png" alt="" />
						<input type="submit" class="formbutton" value="Delete Selected" name="groupaction"/>
						<span style="float:right" id="rspc"></span>
					</td>
				</tr>
			{/if}
			</table>
			</form>
			<br/>
			<hr noshade size="1">
			<form action="admin.php" method="post">
				<input type="hidden" name="page" value="{$page}">
				<br/><br/>&nbsp;Add New Category:
				<input type="text" size="40" name="addcat" value="" style="width:30%"/>
				<select name="selGrp">
				{foreach item=ig key=key from=$groups}
					<option value="{$ig.id}">{$ig.name}</option>
				{/foreach}
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
{/if}

<div class="clear"></div>
