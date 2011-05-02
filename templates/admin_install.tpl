{* ***** BEGIN LICENSE BLOCK *****
 * Version: MIT/X11 License
 * 
 * Copyright (c) 2010 Diego Casorran
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
	padding:120px;
	height: 100%;
	color:#eee;
	margin:0 auto;
}
.con h1 {
	font:italic 28px Georgia;
	margin-top:20px;
}
.note {
	margin-top:22px;
	clear:both;
	text-align:center;
	font:18px Tahoma;
}
</style>
{/literal}


<div class="con">
{if $error_msg == ''}
<img src="http://cdn1.iconfinder.com/data/icons/orchestra/png/128/mypc_ok.png" align="right"> 
<h1><br>The Installation was successful,<br>you can now proceed to your website.</h1>
{else}
<img src="http://cdn1.iconfinder.com/data/icons/VistaICO_Toolbar-Icons/128/Symbol-Error.png" align="right"> 
<h1>The installation failed! the<br>following errors where found:</h1>
<br>{$error_msg}
<br>
<br><div class="note"><strong>Note:</strong> Further installation tryes have been disabled until a real administrator review the issue...</div>
{/if}

</div>
{/strip}
{include file="footer.tpl"}
