<?php /* Smarty version 2.6.28, created on 2016-05-27 09:22:59
         compiled from resultaten.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'resultaten.tpl', 4, false),array('modifier', 'regex_replace', 'resultaten.tpl', 28, false),array('function', 'cycle', 'resultaten.tpl', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><a href="/mgw/">De oude Nederlandse maten en gewichten</a></h1>
<p>beginletter plaats: <?php $_from = $this->_tpl_vars['letters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['letter']):
?>
	<a href="/mgw/plaatsen/<?php echo $this->_tpl_vars['letter']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['letter'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</a> | 
<?php endforeach; endif; unset($_from); ?></p>
<p>provincie: <?php $_from = $this->_tpl_vars['provincies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prov']):
?>
	<a href="/mgw/plaatsen/<?php echo $this->_tpl_vars['prov']; ?>
"><?php echo $this->_tpl_vars['prov']; ?>
</a> | 
<?php endforeach; endif; unset($_from); ?></p>
<p>type: <?php $_from = $this->_tpl_vars['typen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
	<a href="/mgw/maten/<?php echo $this->_tpl_vars['type']['id']; ?>
"><?php echo $this->_tpl_vars['type']['type']; ?>
</a> | 
<?php endforeach; endif; unset($_from); ?></p>
<hr />
<?php if ($this->_tpl_vars['plaatsen']): ?>
	<?php $_from = $this->_tpl_vars['plaatsen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plaats_id'] => $this->_tpl_vars['plaats']):
?>
		<a href="/mgw/plaats/<?php echo $this->_tpl_vars['plaats_id']; ?>
"><?php echo $this->_tpl_vars['plaats']['plaats']; ?>
</a> (<?php if ($this->_tpl_vars['plaats']['regio']): ?><?php echo $this->_tpl_vars['plaats']['regio']; ?>
, <?php endif; ?><?php echo $this->_tpl_vars['plaats']['provincie']; ?>
)<br />
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['plaatsnaam']): ?>
	<h2><?php echo $this->_tpl_vars['plaatsnaam']; ?>
 (<?php if ($this->_tpl_vars['regio']): ?><?php echo $this->_tpl_vars['regio']; ?>
, <?php endif; ?><?php echo $this->_tpl_vars['provincie']; ?>
)</h2>
	<table>
	<?php $_from = $this->_tpl_vars['matenperplaats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['maat']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
">
			<td class="maattype"><?php echo $this->_tpl_vars['maat']['type']; ?>
</td>
			<td class="omschrijving"><?php echo $this->_tpl_vars['maat']['type_omschrijving']; ?>
</td>
			<td class="maatnaam"><?php echo $this->_tpl_vars['maat']['naam']; ?>
</td>
			<td><?php if ($this->_tpl_vars['maat']['metrieke_waarde'] != '0'): ?><?php echo $this->_tpl_vars['maat']['metrieke_waarde']; ?>
<?php endif; ?></td>
			<td><?php echo $this->_tpl_vars['maat']['eenheid']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['maat']['bron'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "!^/ !", "") : smarty_modifier_regex_replace($_tmp, "!^/ !", "")); ?>
</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>
<?php endif; ?>
<?php if ($this->_tpl_vars['plaatsenpermaat']): ?>
	<h2><?php echo $this->_tpl_vars['maattype']; ?>
: <?php echo $this->_tpl_vars['maatnaam']; ?>
</h2>
	<?php $_from = $this->_tpl_vars['plaatsenpermaat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plaats'] => $this->_tpl_vars['maatjes']):
?>
		<div class="plaatspermaat">
		<h3><?php echo $this->_tpl_vars['plaats']; ?>
</h3>
		<?php $_from = $this->_tpl_vars['maatjes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['maat']):
?>
		<table>
			<tr>
				<td class="omschrijving"><?php echo $this->_tpl_vars['maat']['type_omschrijving']; ?>
</td>
<!-- 
				<td><?php echo $this->_tpl_vars['maat']['hoeveelheid']; ?>
</td>
 -->
				<td class="maatnaam"><?php echo $this->_tpl_vars['maat']['naam']; ?>
</td>
				<td><?php if ($this->_tpl_vars['maat']['metrieke_waarde'] != '0'): ?><?php echo $this->_tpl_vars['maat']['metrieke_waarde']; ?>
<?php endif; ?></td>
				<td><?php echo $this->_tpl_vars['maat']['eenheid']; ?>
</td>
				<td><span class="bron"><?php echo ((is_array($_tmp=$this->_tpl_vars['maat']['bron'])) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "!^/ !", "") : smarty_modifier_regex_replace($_tmp, "!^/ !", "")); ?>
</span></td>
			</tr>
		</table>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['maten']): ?>
	<h2><?php echo $this->_tpl_vars['maattype']; ?>
</h2>
	<?php $_from = $this->_tpl_vars['maten']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['maat']):
?>
		<a href="/mgw/maat/<?php echo $this->_tpl_vars['maat']['id']; ?>
"><?php echo $this->_tpl_vars['maat']['naam']; ?>
</a><br />
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>