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

	<div id="head_content">
		
		{if isset($logo) && $logo != ''}
			
			<a href="/"><img src="{$logo}" alt="{$description}" /></a>
			
		{/if}
		
	</div>
	
	<div id="sbar_content">
		
		<form id="SearchForm" method="get" action="javascript:void(0)" onsubmit="return SubmitSearch(this);">
			<img src="images/spacer.gif" width="88" height="31" border="0" alt="" />
			<input type="text" value="" name="query" id="SearchQuery" size="50" />
			<select id="SearchSelect" onchange="javascript:SelectSearch(this)">
				<option selected="selected" value="0">Google.no</option>
				<option value="1">Kvasir.no</option>
				<option value="2">Gulesider.no</option>
			</select>
			<input type="submit" value="S&oslash;k" />
		</form>
		{*literal*}
		<script type="text/javascript">
			var Engines = {
				0: {
					logo: 'images/google.png',
					requ: 'http://www.google.no/search?hl=no&amp;q='
				},
				1: {
					logo: 'images/kvasir.png',
					requ: 'http://www.kvasir.no/alle?q='
				},
				2: {
					logo: 'images/gulesider.png',
					requ: 'http://www.gulesider.no/query?what=cs&amp;search_word='
				},
			};
			function SubmitSearch() {
				var s = document.getElementById('SearchSelect');
				var q = document.getElementById('SearchQuery').value;
				window.location = Engines[s.options[s.selectedIndex].value].requ.replace('&amp;','\u0026') + encodeURIComponent(q);
			}
			function SelectSearch(s) {
				s.parentNode.firstChild.src = Engines[s.options[s.selectedIndex].value].logo;
			}
			window.onload = function() {
				SelectSearch(document.getElementById('SearchSelect'));
			}
		</script>
		{*/literal*}
	</div>
	
	<div id="main_content">
		
		<div id="mc_left">
			
			{if $groups|default:0}
				
				<ul id="grplist">
				<li><a href="index.php"{if $grpid == 0} class="active"{/if}>Forsiden</a></li>
				
				{foreach item=item key=key from=$groups}
					
					<li><a href="{$item.link}"{if $selgroup == $item.name} class="active"{/if}>{$item.name}</a></li>
					
				{/foreach}
				
				</ul>
			{/if}
			
		</div>
		<div id="mc_left_c">
			
			{if $categories|default:0}
				
				{*<span style="float:left">&nbsp;-&nbsp;</span>*}
				
				<ul id="catlist">
				
				{foreach item=item key=key from=$categories}
					
					{*<li><a href="index.php?g={$grpid}&amp;c={$item.id}"{if $selcat == $item.name} class="active"{/if}>{$item.name}</a></li>*}
					<li><a href="{$item.link}"{if $selcat == $item.name} class="active"{/if}>{$item.name}</a></li>
					
				{/foreach}
				
				</ul>
			{/if}
			<div class="clear"></div>
		</div>
		<div id="mc_centre">
			
			<div id="mcc_title"><!--{$selgroup|default:"Home"}--></div>
			<div id="mcc_content">
				
				<ul id="lnklist">
				
				{foreach item=item key=key from=$links}
					
					<li>
						<a href="{$item.link}" target="_blank">
							<img src="images/logos/{$item.grpid}/{$item.catid}/{$item.id}.png" alt="{$item.title}" title="{$item.title}" width="96" height="96" />
						</a>
					</li>
					
				{/foreach}
				
				</ul>
			</div>
		</div>
		<div id="mc_right">
			{$rsbanner}
		</div>
		<div id="mc_bottom">
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="footer">
		<a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage(window.location.href);"><b>Bruk som startside</b></a>
		&nbsp;<b>&middot;</b>&nbsp; <a href="aboutus.html"><b>About us</b></a>
		&nbsp;<b>&middot;</b>&nbsp; <a href="contact.html"><b>Contact</b></a>
		{*&nbsp;<b>&middot;</b>&nbsp; <a href=""><b></b></a>*}
	</div>

{/strip}
{include file="footer.tpl"}