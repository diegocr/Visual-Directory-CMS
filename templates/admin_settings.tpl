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
form input[type=text], form input[type=file], form input[type=password], textarea, select#leftmenuorder {
	padding:1px;
	font:bold 12px Helvetica;
	background-color:#777 !important;
	clear:both;
	float:right;
	min-width: 300px;
}
form input[type=submit] {
	background-color:#fff;
	float:left;
	min-width:120px;
}
.isep {
	clear:both;
	height:10px;
}
option {
  background-color: #181818;
  border: 0 none;
  color: #EEEEEE;
}
</style>
{/literal}

<div class="centre" style="width:500px">
	
	<br>
	<br>
	<br>
	
	<form action="admin.php" method="post" enctype="multipart/form-data">
		
		<input type="hidden" name="page" value="{$page}">
		<input type="hidden" name="saveset" value="1">
		
		<label for="title">Site Title: </label>
		<input type="text" name="title" id="title" value="{$title|default:""}">
		<div class="isep"></div>
		
		<label for="desc">Site Description: </label>
		<input type="text" name="description" id="desc" value="{$description|default:""}">
		<div class="isep"></div>
		
		<label for="metakeys">Meta Tags: </label>
		<input type="text" name="metakeys" id="metakeys" value="{$metakeys|default:""}">
		<div class="isep"></div>
		
		<label for="template">Template Path: </label>
		<input type="text" name="template" id="template" value="{$template|default:""}">
		<div class="isep"></div>
		
		<label for="leftmenuorder">Left Menu Order: </label>
		<select name="leftmenuorder" id="leftmenuorder">
			<option value="0" {if $leftmenuorder == 0} selected{/if}>Alphabetical</option>
			<option value="1" {if $leftmenuorder == 1} selected{/if}>By ID</option>
		</select>
		<div class="isep"></div>
		
		<label for="leftmenuitems">Left Menu Items: </label>
		<input type="text" name="leftmenuitems" id="leftmenuitems" value="{$leftmenuitems|default:"16"}">
		<div class="isep"></div>
		
		<label for="rsbanner">Right-Side Banner: </label>
		<textarea rows="4" cols="40" name="rsbanner" id="rsbanner">{$rsbanner|default:""}</textarea>
		<div class="isep"></div>
		
		<label for="logo">Logo Image: </label>
		<input type="file" name="logo" id="logo" value="{$logo|default:""}">
		<div class="isep"></div>
		
		<label for="bgimg">Background Image: </label>
		<input type="file" name="background" id="bgimg" value="{$background|default:""}">
		<div class="isep"></div>
		
		<input type="submit" value="Save Settings" style="margin-left:202px;">
		
	</form>
	
	<div class="clear"></div>
	<div class="clear"></div>


</div>
<br><hr><br>
<div class="centre">
	
	<h1>Online Template Editor</h1>
	<br>
	<br>
	
	<form action="admin.php" method="post" name="TPLEditForm">
		
		<input type="hidden" name="page" value="{$page}">
		
	{if $tplfile != ''}
			
			<input type="hidden" name="savetpl" value="1">
			<input type="hidden" name="tplfile" value="{$tplfile}">
			<big>Currently Editing <b><em>{$tplfile}</em></b></big>
			<br>
			<br>
			
			{$tplfile_c}
			
			<br>
			<br>
			<input type="submit" value="Save File">
			<input type="submit" name="cancel" value="Cancel">
	{else}
		
		<span class="pad10"><big>Select file to edit:</big>
		<select name="tplfile" onchange="TPLEditForm.submit()">
			<option value="">-- click to browse --</option>
			{foreach $template_files as $file}
				<option value="{$file}">{$file}</option>
			{/foreach}
		</select></span>
		
	{/if}
	</form>
	<div class="clear"></div>
</div>
	<br>
	<br>
	<br>

{/strip}
{include file="admin_footer.tpl"}
