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
<script type="text/javascript">
var groups = {$json_groups};
var group_ids = {$json_group_ids};
var sel_catid = {$sel_catid|default:0};
var sel_grpid = {$sel_grpid|default:0};
var linkedit_err = {$linkedit_err|default:0};
{literal}
window.onload = function() {
	var s = document.getElementById('Groups');
	for (var key in groups) {
		var o = document.createElement('option');
		o.class = o.className = 'ml';
		o.value = o.innerHTML = key;
		s.appendChild(o);
	}
	if(sel_grpid && !linkedit_err) {
		for(var i = 0; i < s.options.length; ++i) {
			if(s.options[i].value == group_ids[sel_grpid]) {
				s.selectedIndex = i;
				s.onchange();
				break;
			}
		}
		sel_grpid = 0;
	}
};
function GorupSelect(s) {
	var group = s.options[s.selectedIndex].value;
	var c = document.getElementById('Categories');
	while(c.firstChild)
		c.removeChild(c.firstChild);
	var g = groups[group];
	for (var x in g) {
		var o = document.createElement('option');
		o.class = o.className = 'ml';
		o.value = g[x];
		o.innerHTML = x.length < 1 || x == group ? '~[Group Logos]~':x;
		c.appendChild(o);
	}
	if(sel_catid && !linkedit_err) {
		for(var i = 0; i < c.options.length; ++i) {
			if(c.options[i].value == sel_catid) {
				c.selectedIndex = i;
				c.onchange();
				break;
			}
		}
		sel_catid = 0;
	}
}
function CategorySelect(s) {
	var xhr=(window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Msxml2.XMLHTTP"));
	if(!xhr){alert('xhr unavailable');return;}
	
	var DivOutput = document.getElementById('DivOutput');
	while(DivOutput.firstChild)
		DivOutput.removeChild(DivOutput.firstChild);
	DivOutput.innerHTML = '<img src="http://www.redlasso.com/images/loading.gif"/>';
	
	xhr.onerror = function(){alert('XHR Error');};
	xhr.onreadystatechange = function() {
		if(xhr.readyState!=4)
			return;
		var data;
		if(xhr.status!=200)
			data = 'Server returned error '+xhr.status;
		else
			data = xhr.responseText + '<img src="images/spacer.gif" align="right">';
		DivOutput.innerHTML = data;
	};
	xhr.open("GET",'admin.php?tm='+(new Date().getTime())+'&page=linkedit&c='+s.options[s.selectedIndex].value, true);
	xhr.send(null);
}
{/literal}
</script>
<noscript>JavaScript Must be enabled!</noscript>

<div style="width:200px;float:left;margin-right:10px">

	<form action="javascript:void(0)">
		
		<h2>Groups:</h2>
		<select id="Groups" multiple="multiple" style="height:410px;width:200px" onchange="GorupSelect(this)">
		</select>
		
	</form>
	
	<br/>
	<form action="javascript:void(0)">
		
		<h2>Categories:</h2>
		<select id="Categories" multiple="multiple" style="height:500px;width:200px" onchange="CategorySelect(this)">
		</select>
		
	</form>
	
</div>

<br/>
<div style="width:700px;float:right;border:1px dotted #337;-moz-border-radius:5px;min-height:940px;background:-moz-linear-gradient(top center, #4478AA, #336788);">
	
	<div id="DivOutput" style="width:100%;height:100%;padding:6px;margin:0 auto">
		
		<h3>{$message|default:""}</h3>
		
	</div>
	<div class="clear"></div>
	
</div>

<div class="clear"></div>

{include file="admin_footer.tpl"}
