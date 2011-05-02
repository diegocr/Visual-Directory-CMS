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

class MySQLayer {
	
	private $dbcid;
	private $dbpfx;
	private $result;
	public $lastQuery;
	public $debug;
	
	public function __construct($hostname, $username, $password, $database, $dbpfx = '') {
		
		if(($this->dbcid = @mysql_connect($hostname, $username, $password))) {
			if(!empty($database)) {
				if(!(@mysql_select_db($database))) {
					$this->Query('CREATE DATABASE `'.$database.'`;');
					if(!(@mysql_select_db($database))) {
						@mysql_close($this->dbcid);
						$this->dbcid = false;
					}
				}
			}
		}
		
		if( ! $this->dbcid ) {
			@ob_end_clean();
			@ob_end_clean();
			@header($_SERVER['SERVER_PROTOCOL'].' 503 Service Temporarly Unavailable');
			@header('Retry-After: '.mt_rand(2000,3000)*40);
			@header('X-Powered-By:');
			die('Database connection error. Please try again later.');
		}
		
		$this->dbpfx = $dbpfx;
		$this->debug = isset($_SESSION['admin']);
	}
	
	public function __destruct() {
		
		if( $this->dbcid ) {
			
			if($this->result) {
				@mysql_free_result($this->result);
				$this->result = null;
			}
			
			@mysql_close($this->dbcid);
			$this->dbcid = false;
		}
	}
	
	public function Query($query = '',$args = null) {
		$this->result = null;
		if(!empty($query)) {
			if(!empty($args)) {
				if(!is_array($args)) $args = array($args);
				while(($p=strpos($query,'!')) !== false) {
					$query = substr_replace($query,'`'.str_replace('%',$this->dbpfx,array_shift($args)).'`',$p,1);
				}
				if(is_array($args) && !empty($args)) {
					foreach($args as &$v)
						$v = (($v === null) ? 'NULL' : (is_numeric($v) ? $v
						: "'".mysql_real_escape_string((string)$v, $this->dbcid)."'"));
					$query = vsprintf(str_replace('?','%s',$query), $args);
				}
			}
			$this->result = @mysql_query($query, $this->dbcid);
			
			if( $this->debug ) {
				$this->lastQuery = $query;
				if(!$this->result ) {
					echo '<br/>'.$this->ErrorStr();
				}
			}
		}
		return $this->result;
	}
	
	public function NumRows($query_id = 0) {
		return(($query_id || ($query_id = $this->result)) ? @mysql_num_rows($query_id) : false);
	}
	
	public function AffectedRows() {
		return $this->dbcid ? @mysql_affected_rows($this->dbcid) : false;
	}
	
	public function FetchRow($query_id = 0) {
		return(($query_id || ($query_id = $this->result)) ? @mysql_fetch_assoc($query_id) : false);
	}
	
	public function GetOne($query,$args = null) {
		$row = $this->FetchRow($this->Query($query . ' LIMIT 0,1',$args));
		$this->FreeResult();
		return $row;
	}
	
	public function GetFirst($query,$args = null) {
		list($first) = @array_values($this->GetOne($query,$args));
		return $first;
	}
	
	public function FetchRowSet($query_id = 0,$something=null) {
		if(is_string($query_id)) {
			$query_id = $this->Query($query_id,$something);
		}
		if(!$query_id)$query_id = $this->result;
		if(!$query_id)return false;
		$result = array();
		while($row = @mysql_fetch_assoc($query_id)) {
			$result[] = $row;
			unset($row);
		}
		return $result;
	}
	
	public function FreeResult($query_id = 0) {
		if($query_id || ($query_id = $this->result)) {
			@mysql_free_result($query_id);
		}
		return !!$query_id;
	}
	
	public function Error(&$message=null) {
		if($message !== null)
			$message = @mysql_error($this->dbcid);
		return intval(@mysql_errno($this->dbcid));
	}
	
	public function ErrorStr() {
		$msg = '';
		$cod = $this->Error($msg);
		return 'Error '.$cod.': '.$msg;
	}
}

?>