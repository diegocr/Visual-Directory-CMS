<?php /* Smarty version Smarty-3.0.6, created on 2011-03-04 04:09:28
         compiled from ".\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2214d7057e8606271-48856232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10e0737838b4a574ef135d0c601e7b602cfaf37a' => 
    array (
      0 => '.\\templates\\header.tpl',
      1 => 1299188505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2214d7057e8606271-48856232',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include 'C:\xampp\htdocs\VD\smarty\plugins\modifier.capitalize.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo smarty_modifier_capitalize((($tmp = @$_smarty_tpl->getVariable('title')->value)===null||$tmp==='' ? $_SERVER['HTTP_HOST'] : $tmp));?>
</title>
<meta name="description" content="<?php echo (($tmp = @$_smarty_tpl->getVariable('description')->value)===null||$tmp==='' ? "Visual Directory" : $tmp);?>
" />
<meta name="keywords" content="<?php echo (($tmp = @$_smarty_tpl->getVariable('metakeys')->value)===null||$tmp==='' ? '' : $tmp);?>
" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="author" content="<?php echo $_SERVER['HTTP_HOST'];?>
" />
<meta name="copyright" content="Copyright (C)2010 <?php echo $_SERVER['HTTP_HOST'];?>
" />
<meta name="language" content="english" />
<meta name="robots" content="INDEX, FOLLOW" />
<meta name="revisit-after" content="20 DAYS" />
<meta name="rating" content="general" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="StyleSheet" href="templates/default.css" type="text/css" />
<?php if (isset($_smarty_tpl->getVariable('background',null,true,false)->value)&&$_smarty_tpl->getVariable('background')->value!=''){?>
<style type="text/css">body {background: #e1e1e1 url(<?php echo $_smarty_tpl->getVariable('background')->value;?>
) top center repeat !important;}</style>
<?php }?>
</head>
<body><div class="globalContainer" id="gCid">
