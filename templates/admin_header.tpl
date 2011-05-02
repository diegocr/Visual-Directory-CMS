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
{/literal}
<div class="adm_con">

<div class="adm_header">

	<div class="left" style="padding-top:30px">
		Admin Panel
	</div>

	<div class="right">
		<img src="images/administrator.png">
	</div>
	
	<div class="clear"></div>
	
	<ul>
		<li><a href="admin.php">Home</a></li>
		<li><a href="admin.php?page=settings">Settings</a></li>
		<li><a href="admin.php?page=accs">Admin Management</a></li>
		<li><a href="admin.php?page=categories">Categories</a></li>
		<li><a href="admin.php?page=links">Links</a></li>
		<li><a href="admin.php?page=crawler">Crawler</a></li>
		<li><a href="admin.php?page="></a></li>
		<li style="float:right;padding-right:26px"><a href="admin.php?page=logout">Logout</a></li>
	</ul>

</div>

<div class="adm_content">
<div class="adm_content_title" align="right">{$adm_title|default:"Administration"}</div>
<div class="adm_content_container">

{/strip}
