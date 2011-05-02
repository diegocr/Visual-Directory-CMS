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

<style>
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
form.le input[type=text] {
	width:98%;
}
form.le input.aabh {
	width:280px;
	float:right;
}
form.le input.dfer {
	width:230px;
	float:right;
}
form.le input[type=submit] {
	color:#001;
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

	
	<form class="le left" action="admin.php" method="post">
		
		<input type="hidden" name="page" value="{$page}">
		<input type="hidden" name="catid" value="{$catid}">
		<input type="hidden" name="grpid" value="{$grpid}">
		<input type="hidden" name="seoid" value="{$seoid|default:0}">
		
		<div><h3>SEO Data</h3></div>
		
		<label for="title">Title:</label>
		<input class="dfer" type="text" name="mtitle" id="title" value="{$mtitle|default:""}">
		
		<br/><label for="desc">Description:</label>
		<input class="dfer" type="text" name="mdesc" id="desc" value="{$mdesc|default:""}">
		
		<br/><label for="mkeys">Keywords:</label>
		<input class="dfer" type="text" name="mkeys" id="mkeys" value="{$mkeys|default:""}">
		
		<input style="margin:16px auto 0" type="submit" name="saveseo" value="Save SEO Settings"/>
	</form>
	
	<form class="le right" action="admin.php" method="post" enctype="multipart/form-data">
		
		<input type="hidden" name="page" value="{$page}">
		<input type="hidden" name="catid" value="{$catid}">
		<input type="hidden" name="grpid" value="{$grpid}">
		<input type="hidden" name="savelink" value="-1">
		
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" value="">
		
		<br/><label for="link">Link:</label>
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

<div class="clear" style="width:90%;border-bottom:1px solid #556;padding:8px 0"></div>



{if $cats != ''}
	
	{foreach item=item key=key from=$cats}
		<form class="le {cycle values="left,right"}" action="admin.php" method="post" enctype="multipart/form-data">
			
			<input type="hidden" name="page" value="{$page}">
			<input type="hidden" name="savelink" value="{$item.id}">
			<input type="hidden" name="catid" value="{$item.catid}">
			<input type="hidden" name="grpid" value="{$item.grpid}">
			
			<label for="title">Title:</label>
			<input class="aabh" type="text" name="title" id="title" value="{$item.title|default:""}">
			
			<br/><label for="title">Link:</label>
			<input class="aabh" type="text" name="link" id="link" value="{$item.link|default:""}">
			
			<div class="imu">
				<img style="float:right" alt="Current Logo" title="Current Logo" src="images/logos/{$item.grpid}/{$item.catid}/{$item.id}.png" width="64" height="50" />
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
	{/foreach}
{/if}

		<div class="clear"></div>
		