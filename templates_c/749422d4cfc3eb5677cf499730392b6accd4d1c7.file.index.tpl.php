<?php /* Smarty version Smarty-3.0.6, created on 2011-02-25 11:53:25
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:284924d678a2588e989-87358242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1298631182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284924d678a2588e989-87358242',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="head_content"><?php if (isset($_smarty_tpl->getVariable('logo',null,true,false)->value)&&$_smarty_tpl->getVariable('logo')->value!=''){?><img src="<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" alt="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" /><?php }?></div><div id="sbar_content"><form id="SearchForm" method="get" action="javascript:void(0)" onsubmit="return SubmitSearch(this);"><img src="images/spacer.gif" width="88" height="31" border="0" alt="" /><input type="text" value="" name="query" id="SearchQuery" size="50" /><select id="SearchSelect" onchange="javascript:SelectSearch(this)"><option selected="selected" value="0">Google.no</option><option value="1">Kvasir.no</option><option value="2">Gulesider.no</option></select><input type="submit" value="S&oslash;k" /></form><script type="text/javascript">var Engines = {0: {logo: 'images/google.png',requ: 'http://www.google.no/search?hl=no&amp;q='},1: {logo: 'images/kvasir.png',requ: 'http://www.kvasir.no/alle?q='},2: {logo: 'images/gulesider.png',requ: 'http://www.gulesider.no/query?what=cs&amp;search_word='},};function SubmitSearch() {var s = document.getElementById('SearchSelect');var q = document.getElementById('SearchQuery').value;window.location = Engines[s.options[s.selectedIndex].value].requ.replace('&amp;','\u0026') + encodeURIComponent(q);}function SelectSearch(s) {s.parentNode.firstChild.src = Engines[s.options[s.selectedIndex].value].logo;}window.onload = function() {SelectSearch(document.getElementById('SearchSelect'));}</script></div><div id="main_content"><div id="mc_left"><?php if ((($tmp = @$_smarty_tpl->getVariable('groups')->value)===null||$tmp==='' ? 0 : $tmp)){?><ul id="grplist"><li><a href="index.php"<?php if ($_smarty_tpl->getVariable('grpid')->value==0){?> class="active"<?php }?>>Forsiden</a></li><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?><li><a href="index.php?g=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"<?php if ($_smarty_tpl->getVariable('selgroup')->value==$_smarty_tpl->tpl_vars['item']->value['name']){?> class="active"<?php }?>><?php echo htmlentities($_smarty_tpl->tpl_vars['item']->value['name']);?>
</a></li><?php }} ?></ul><?php }?></div><div id="mc_centre"><div id="mcc_title"><!--<?php echo (($tmp = @$_smarty_tpl->getVariable('selgroup')->value)===null||$tmp==='' ? "Home" : $tmp);?>
--></div><div id="mcc_content"><ul id="lnklist"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('links')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?><li><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="_blank"><img src="images/logos/<?php echo $_smarty_tpl->tpl_vars['item']->value['grpid'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['catid'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
.png" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" width="96" height="96" /></a></li><?php }} ?></ul></div></div><div id="mc_right"><?php if ((($tmp = @$_smarty_tpl->getVariable('categories')->value)===null||$tmp==='' ? 0 : $tmp)){?><ul id="catlist"><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?><li><a href="index.php?g=<?php echo $_smarty_tpl->getVariable('grpid')->value;?>
&amp;c=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"<?php if ($_smarty_tpl->getVariable('selcat')->value==$_smarty_tpl->tpl_vars['item']->value['name']){?> class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li><?php }} ?></ul><?php }?><div class="clear"></div></div><div class="clear"></div></div><div class="footer"><a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage(window.location.href);"><b>Bruk som startside</b></a>&nbsp;<b>&middot;</b>&nbsp; <a href="aboutus.html"><b>About us</b></a>&nbsp;<b>&middot;</b>&nbsp; <a href="contact.html"><b>Contact</b></a></div>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>