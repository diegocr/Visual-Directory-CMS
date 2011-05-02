<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 13:25:15
         compiled from ".\templates\admin_links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:273224d679fab0788f0-41641373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f7ae21d08aadae61382b0199ca61fc50a868e3b' => 
    array (
      0 => '.\\templates\\admin_links.tpl',
      1 => 1298164681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '273224d679fab0788f0-41641373',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("admin_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<script type="text/javascript">
var groups = <?php echo $_smarty_tpl->getVariable('json_groups')->value;?>
;
var group_ids = <?php echo $_smarty_tpl->getVariable('json_group_ids')->value;?>
;
var sel_catid = <?php echo (($tmp = @$_smarty_tpl->getVariable('sel_catid')->value)===null||$tmp==='' ? 0 : $tmp);?>
;
var sel_grpid = <?php echo (($tmp = @$_smarty_tpl->getVariable('sel_grpid')->value)===null||$tmp==='' ? 0 : $tmp);?>
;
var linkedit_err = <?php echo (($tmp = @$_smarty_tpl->getVariable('linkedit_err')->value)===null||$tmp==='' ? 0 : $tmp);?>
;

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
		o.innerHTML = x;
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
		
		<h3><?php echo (($tmp = @$_smarty_tpl->getVariable('message')->value)===null||$tmp==='' ? '' : $tmp);?>
</h3>
		
	</div>
	<div class="clear"></div>
	
</div>

<div class="clear"></div>

<?php $_template = new Smarty_Internal_Template("admin_footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
