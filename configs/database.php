<?php
/* ***** BEGIN LICENSE BLOCK *****
 * Version: MIT/X11 License
 * 
 * Copyright (c) 2013 Diego Casorran
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
 * ***** END LICENSE BLOCK ***** */

?><?php

/**
 * Visual Directory CMS
 * Copyright(C)2011 Diego Casorran <dcasorran[at]gmail.com>
 * All Rights Reserved.
 * 
 */

defined('IN_VDCORE') or die('Access Denied');

######################################################################
# Database Config
#
# $dbhost:     SQL Database Hostname
# $dbuname:    SQL Username
# $dbpass:     SQL Password
# $dbname:     SQL Database Name
# $dbpfx:      Your Database table's prefix
######################################################################

if(defined('IN_VDCORE_LOCAL')) {
	$dbhost  = "localhost";
	$dbuname = "test";
	$dbpass  = "test";
	$dbname  = "VD_Db";
} else {
	$dbhost  = "mysql5.mit.edu";
	$dbuname = "aG9ubmluZ2s";
	$dbpass  = "YzY3NTZlYjc";
	$dbname  = "aG9ubmluZ2s";
}

$dbpfx  = "vd";

?>