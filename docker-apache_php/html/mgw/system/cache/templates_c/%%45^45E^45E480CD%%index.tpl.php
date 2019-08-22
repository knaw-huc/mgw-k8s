<?php /* Smarty version 2.6.28, created on 2016-05-27 09:22:50
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'index.tpl', 27, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="/tools/jquery/1.4.2/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
<?php echo '
$(document).ready(function() { 
	$(\'#colofonlink\').click(function() {
		if ($(\'#colofon\').is(\':hidden\')) {
			$(\'#colofon\').fadeIn(600);
		} else {
			$(\'#colofon\').hide();
		}
		return false;
	});	
});
'; ?>

</script>
<h1>De oude Nederlandse maten en gewichten</h1>
<a href="<?php echo $this->_tpl_vars['base_url']; ?>
"><img src="<?php echo $this->_tpl_vars['base_url']; ?>
images/mgw_167x181.jpg" alt="omslag Verhoeff" style="float:right;" border="0" hspace="15" /></a>
	<p>Deze databank is gebaseerd op het boek <cite>De oude Nederlandse maten en gewichten</cite> van J.M. Verhoeff uit 1982 en bevat historische metrologische gegevens van vóór 1820. Het is de webversie van een databank die is samengesteld door Ritzo Holtman, redacteur van het door de <a href="http://www.gmvv.org/">Gewichten en Maten Verzamelaars Vereniging</a> uitgegeven tijdschrift <cite>Meten &amp; Wegen</cite>.</p>
	<blockquote>"De historische metrologie is slechts een bescheiden plaatsje toegemeten aan Clio's rijkvoorziene tafel, maar vrijwel nergens is deze hulpwetenschap een stiefmoederlijker behandeling ten deel gevallen dan in ons land."</blockquote>
	<p>Aldus Verhoeff die met <cite>De oude Nederlandse maten en gewichten</cite> heeft geprobeerd te voorzien in de behoefte aan een naslagwerk op het gebied van de historische metrologie. Hiervoor heeft hij gebruik gemaakt van gegevens die zijn verzameld op de afdeling Naamkunde en Nederzettingsgeschiedenis van het P.J. Meertens-Instituut. Het gaat om gegevens uit het einde van de 18e en het begin van de 19e eeuw; toen pas werd begonnen met het systematisch verzamelen van gegevens uit vrijwel het gehele land. In die tijd waren het veranderlijke gegevens en men moet ze daarom ook interpreteren als 'momentopnamen'.</p>
	<p>Naast een geografisch overzicht bevat het boek een woordenlijst met algemene informatie over de maten en gewichten en enige moderne metrologische informatie. Hieruit blijkt dat het 'Nederlandsch Metriek Stelsel' een verzameling Nederlandse benamingen was voor de in 1820 bij wet ingevoerde metrieke maten en gewichten. Deze Nederlandse benamingen werden in 1870 vervangen door de internationale metrieke terminologie. De gegevens in deze databank dateren dus van voor deze ontwikkelingen.</p>
	<p style="font-size:90%"><a href="<?php echo $this->_tpl_vars['base_url']; ?>
literatuur">Literatuur</a> | <a id="colofonlink" href="#">colofon</a> | <a href="/soundbites/disclaimer.php">disclaimer</a></p>
	<div id="colofon"> Aan dit project hebben meegewerkt: Reina Boerrigter, Leendert Brouwer, Ritzo Holtman en Jan Pieter Kunst.</div>
<hr />
<p>beginletter plaats: <?php $_from = $this->_tpl_vars['letters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['letter']):
?>
	<a href="<?php echo $this->_tpl_vars['base_url']; ?>
plaatsen/<?php echo $this->_tpl_vars['letter']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['letter'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a> <span class="scheider">|</span> 
<?php endforeach; endif; unset($_from); ?></p>
<p>provincie: <?php $_from = $this->_tpl_vars['provincies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prov']):
?>
	<a href="<?php echo $this->_tpl_vars['base_url']; ?>
plaatsen/<?php echo $this->_tpl_vars['prov']; ?>
"><?php echo $this->_tpl_vars['prov']; ?>
</a> <span class="scheider">|</span> 
<?php endforeach; endif; unset($_from); ?></p>
<p>type: <?php $_from = $this->_tpl_vars['typen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
	<a href="<?php echo $this->_tpl_vars['base_url']; ?>
maten/<?php echo $this->_tpl_vars['type']['id']; ?>
"><?php echo $this->_tpl_vars['type']['type']; ?>
</a> <span class="scheider">|</span> 
<?php endforeach; endif; unset($_from); ?></p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>