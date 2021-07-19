{include file="header.tpl"}
<script type="text/javascript" src="/tools/jquery/1.4.2/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
{literal}
$(document).ready(function() { 
	$('#colofonlink').click(function() {
		if ($('#colofon').is(':hidden')) {
			$('#colofon').fadeIn(600);
		} else {
			$('#colofon').hide();
		}
		return false;
	});	
});
{/literal}
</script>
<h1>De oude Nederlandse maten en gewichten</h1>
<a href="{$base_url}"><img src="{$base_url}images/mgw_167x181.jpg" alt="omslag Verhoeff" style="float:right;" border="0" hspace="15" /></a>
	<p>Deze databank is gebaseerd op het boek <cite>De oude Nederlandse maten en gewichten</cite> van J.M. Verhoeff uit 1982 en bevat historische metrologische gegevens van vóór 1820. Het is de webversie van een databank die is samengesteld door Ritzo Holtman, redacteur van het door de <a href="http://www.gmvv.org/">Gewichten en Maten Verzamelaars Vereniging</a> uitgegeven tijdschrift <cite>Meten &amp; Wegen</cite>.</p>
	<blockquote>"De historische metrologie is slechts een bescheiden plaatsje toegemeten aan Clio's rijkvoorziene tafel, maar vrijwel nergens is deze hulpwetenschap een stiefmoederlijker behandeling ten deel gevallen dan in ons land."</blockquote>
	<p>Aldus Verhoeff die met <cite>De oude Nederlandse maten en gewichten</cite> heeft geprobeerd te voorzien in de behoefte aan een naslagwerk op het gebied van de historische metrologie. Hiervoor heeft hij gebruik gemaakt van gegevens die zijn verzameld op de afdeling Naamkunde en Nederzettingsgeschiedenis van het P.J. Meertens-Instituut. Het gaat om gegevens uit het einde van de 18e en het begin van de 19e eeuw; toen pas werd begonnen met het systematisch verzamelen van gegevens uit vrijwel het gehele land. In die tijd waren het veranderlijke gegevens en men moet ze daarom ook interpreteren als 'momentopnamen'.</p>
	<p>Naast een geografisch overzicht bevat het boek een woordenlijst met algemene informatie over de maten en gewichten en enige moderne metrologische informatie. Hieruit blijkt dat het 'Nederlandsch Metriek Stelsel' een verzameling Nederlandse benamingen was voor de in 1820 bij wet ingevoerde metrieke maten en gewichten. Deze Nederlandse benamingen werden in 1870 vervangen door de internationale metrieke terminologie. De gegevens in deze databank dateren dus van voor deze ontwikkelingen.</p>
	<p style="font-size:90%"><a href="{$base_url}literatuur">Literatuur</a> | <a id="colofonlink" href="#">colofon</a> | <a href="//www.meertens.knaw.nl/cms/nl/over-het-meertens-instituut/disclaimer">disclaimer</a></p>
	<div id="colofon"> Aan dit project hebben meegewerkt: Reina Boerrigter, Leendert Brouwer, Ritzo Holtman en Jan Pieter Kunst.</div>
<hr />
<p>beginletter plaats: {foreach from=$letters item=letter}
	<a href="{$base_url}plaatsen/{$letter}">{$letter|upper}</a> <span class="scheider">|</span> 
{/foreach}</p>
<p>provincie: {foreach from=$provincies item=prov}
	<a href="{$base_url}plaatsen/{$prov}">{$prov}</a> <span class="scheider">|</span> 
{/foreach}</p>
<p>type: {foreach from=$typen item=type}
	<a href="{$base_url}maten/{$type.id}">{$type.type}</a> <span class="scheider">|</span> 
{/foreach}</p>
{include file="footer.tpl"}