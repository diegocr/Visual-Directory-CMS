<?php
/* ***** BEGIN LICENSE BLOCK *****
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
 * ***** END LICENSE BLOCK ***** */

?><?php

/**
 * Visual Directory CMS
 * Copyright(C)2011 Diego Casorran <dcasorran[at]gmail.com>
 * All Rights Reserved.
 * 
 */

class Security {
	
	private $basedir;
	private $request_keys;
	private $request_values;
	private $globals_registered;
	
	public function __construct($basedir) {
		
		$this->basedir = $basedir;
		
		$this->request_keys = '';
		$this->request_values = @implode('%#',$_REQUEST);
		foreach($_REQUEST as $key => $v) {
			
			$this->request_keys .= $key;
		}
		
		$this->InitialSanityCheck();
		$this->RegisterGlobals();
	}
	
	public function __destruct() {
		
	}
	
	private function GoToHell($msg = '') {
		if(isset($_SESSION['admin']))
			return;
		@ob_end_clean();
		@ob_end_clean();
		@header($_SERVER['SERVER_PROTOCOL'].' 404 GoToHell');
		if(empty($msg))
			$msg = 'Illegal operation.';
		die('[Security Handler] ' . $msg);
	}
	
	private function BanUser($ipaddr = '') {
		
		if(empty($ipaddr))
			$ipaddr = $_SERVER['REMOTE_ADDR'];
		
		$prev = @file_get_contents($this->basedir.'/.htaccess');
		if(empty($prev)) {
			$prev = "\r\n\r\n# Deny From rules added by VD's Security Handler\r\n";
		}
		
		$next = 'deny from ' . $ipaddr . "\r\n";
		
		@file_put_contents($this->basedir.'/.htaccess', $prev . $next );
		$this->GoToHell();
		exit;
	}
	
	private function SanitizeArrayStub(&$data) {
		
		foreach($data as $key => &$value) {
			
			if(!strcasecmp(substr($key,-2),'id')) {
				
				$value = intval($value);
			}
			
			if(!strcasecmp(substr($key,-5),'email')) {
				
				if(!$this->IsValidEMail($value)) {
					
					$this->GoToHell('Invalid E-Mail');
				}
			}
		}
	}
	
	private function InitialSanityCheck() {
		
		if((!empty($this->request_keys) && !preg_match('#^[a-zA-Z0-9_~]+$#',$this->request_keys))
		 || preg_match('!\<(script|style)[^>]*\>.*?(\</\\1\>)?!si',$this->request_values)
		 || preg_match('#\<[a-z]+\s[^>]*(onload|onclick|onmouse[a-z]+)\s*\=#i',$this->request_values)
		 || strpos($this->request_values,'://') !== false
		 || strpos($this->request_values,'../') !== false
		 ){
			$this->GoToHell();
		}
		
		$this->SanitizeArrayStub($_GET);
		$this->SanitizeArrayStub($_POST);
		$this->SanitizeArrayStub($_REQUEST);
	}
	
	private function RegisterGlobalsStub($data) {
		
		foreach($data as $key => $value) {
			
			if(!is_array($value))
				$GLOBALS[$key] = stripslashes($value);
		}
	}
	
	public function RegisterGlobals($user_array = null) {
		
		if(empty($user_array)) {
			
			if($this->globals_registered)
				$this->GoToHell('Globals already registered.');
			
			$this->RegisterGlobalsStub($_GET);
			$this->RegisterGlobalsStub($_POST);
			
			$this->globals_registered = true;
			
		} else {
			$this->RegisterGlobalsStub($user_array);
		}
	}
	
	public function ParamCheck($rules,$doexit = false) {
		
		// eg: array('R'=>array('name'=>'#[a-z]+#i'))
		
		$result = true;
		foreach($rules as $field => $args) {
			
			switch($field) {
				case 'G':
					$a = $_GET;
					break;
				case 'P':
					$a = $_POST;
					break;
				case 'C':
					$a = $_COOKIE;
					break;
				case 'R':
					$a = $_REQUEST;
					break;
				case 'S':
					$a = $_SESSION;
					break;
				default:
					$result = false;
					break;
			}
			
			foreach($args as $key => $pattern) {
				
				if(empty($a[$key]) OR !preg_match($pattern,$a[$key])) {
					
					$result = false;
					break;
				}
			}
			
			if($result == false)
				break;
		}
		
		if($result == false && $doexit)
			$this->GoToHell('Invalid data/parameters');
		
		return $result;
	}
	
	public static function IsValidEMail($user_email) {
		$pat = '!^[a-z0-9\-_\+]+(\.[a-z0-9\-_\+]*)*[^.]@[a-z0-9\-]+\.([a-z0-9\-]+\.)*[a-z]{2,6}$!i';
		
		if(strpos($user_email, '@') !== false && strpos($user_email, '.') !== false) {
			if(preg_match($pat, $user_email))
				return true;
		}
		
		return false;
	}
}

?>