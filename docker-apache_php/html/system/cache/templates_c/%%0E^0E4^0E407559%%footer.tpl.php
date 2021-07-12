<?php /* Smarty version 2.6.28, created on 2016-05-27 09:22:50
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'footer.tpl', 5, false),)), $this); ?>
<div class="stretcher">
<hr />
</div>
<p id="copyright">
&copy; <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%G") : smarty_modifier_date_format($_tmp, "%G")); ?>
 <a href="http://www.meertens.knaw.nl">KNAW/Meertens Instituut</a><br />
	</p>
	</div> <!-- content -->
  </div> <!-- rode rand -->
</div> <!-- dbwrapper -->
<div class="footer">
  <address><span><strong>MEERTENS INSTITUUT</strong> Postbus 94264, 1090 GG Amsterdam. Telefoon +31 (0)20 4628500. Fax +31 (0)20 4628555.</span> <a href="mailto:info@meertens.knaw.nl">info@meertens.knaw.nl</a></address>
</div>
<script src="/cms/templates/mi_hetgelaat/js/meertens.databanken.js"></script>
</body>
</html>