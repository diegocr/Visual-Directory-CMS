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

{include file="header.tpl"}
{strip}
{literal}
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
{/literal}


<div class="con">
<img src="http://cdn1.iconfinder.com/data/icons/general13/png/128/administrator.png" align="right">
<h1>Administration Access</h1>

<div class="box">

{if $error_msg != ''}
<p style="background:#e00;color:#000">{$error_msg}</p>
{else}
<p></p>
{/if}
<br>
<br>
<form action="admin.php" method="post">

	<input type="hidden" name="key" value="{$temp_key}">
	<label for="username">Username:</label>
	<input type="text" id="username" name="adm_user" value="">
	<div class="isep"></div>
	<label for="password">Password:</label>
	<input type="password" id="password" name="adm_pass" value="">
	<div class="isep"></div>
	<div><input type="submit" value="Submit"></div>
</form>

</div>
<br>
</div>




{/strip}
{include file="footer.tpl"}
