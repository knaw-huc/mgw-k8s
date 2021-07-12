{include file="header.tpl"}
<h1><a href="{$base_url}">De oude Nederlandse maten en gewichten</a></h1>
<p>beginletter plaats: {foreach from=$letters item=letter}
	<a href="{$base_url}plaatsen/{$letter}">{$letter|upper}</a> | 
{/foreach}</p>
<p>provincie: {foreach from=$provincies item=prov}
	<a href="{$base_url}plaatsen/{$prov}">{$prov}</a> | 
{/foreach}</p>
<p>type: {foreach from=$typen item=type}
	<a href="{$base_url}maten/{$type.id}">{$type.type}</a> | 
{/foreach}</p>
<hr />
{if $plaatsen}
	{foreach from=$plaatsen key=plaats_id item=plaats}
		<a href="{$base_url}plaats/{$plaats_id}">{$plaats.plaats}</a> ({if $plaats.regio}{$plaats.regio}, {/if}{$plaats.provincie})<br />
	{/foreach}
{/if}
{if $plaatsnaam}
	<h2>{$plaatsnaam} ({if $regio}{$regio}, {/if}{$provincie})</h2>
	<table>
	{foreach from=$matenperplaats item=maat}
		<tr class="{cycle values=odd,even}">
			<td class="maattype">{$maat.type}</td>
			<td class="omschrijving">{$maat.type_omschrijving}</td>
			<td class="maatnaam">{$maat.naam}</td>
			<td>{if $maat.metrieke_waarde != '0'}{$maat.metrieke_waarde}{/if}</td>
			<td>{$maat.eenheid}</td>
			<td>{$maat.bron|regex_replace:"!^/ !":""}</td>
		</tr>
	{/foreach}
	</table>
{/if}
{if $plaatsenpermaat}
	<h2>{$maattype}: {$maatnaam}</h2>
	{foreach from=$plaatsenpermaat key=plaats item=maatjes}
		<div class="plaatspermaat">
		<h3>{$plaats}</h3>
		{foreach from=$maatjes item=maat}
		<table>
			<tr>
				<td class="omschrijving">{$maat.type_omschrijving}</td>
<!-- 
				<td>{$maat.hoeveelheid}</td>
 -->
				<td class="maatnaam">{$maat.naam}</td>
				<td>{if $maat.metrieke_waarde != '0'}{$maat.metrieke_waarde}{/if}</td>
				<td>{$maat.eenheid}</td>
				<td><span class="bron">{$maat.bron|regex_replace:"!^/ !":""}</span></td>
			</tr>
		</table>
		{/foreach}
		</div>
	{/foreach}
{/if}

{if $maten}
	<h2>{$maattype}</h2>
	{foreach from=$maten item=maat}
		<a href="{$base_url}maat/{$maat.id}">{$maat.naam}</a><br />
	{/foreach}
{/if}
{include file="footer.tpl"}