<?php
$this->set('title_for_layout', 'Admin Panel ['.$this->Session->read('Account.name').']');
echo $this->Html->css('/libs/jquery-ui/jquery-ui');
echo $this->Html->script('/libs/jquery-ui/jquery-ui.min');

echo $this->Html->css('/libs/elfinder/css/elfinder.min');
echo $this->Html->css('/libs/elfinder/css/theme');
echo $this->Html->script('/libs/elfinder/js/elfinder.min');
echo $this->Html->script('/libs/elfinder/js/i18n/elfinder.pt_BR');
?>

<script type="text/javascript" charset="utf-8">
	$().ready(function() {
		var elf = $('#elfinder').elfinder({
			url : '<?php echo url; ?>libs/elfinder/php/connector.php'  // connector URL (REQUIRED)
			// lang: 'pt_BR',             // language (OPTIONAL)
		}).elfinder('instance');
	});
</script>
<div class="panel panel-default panel-body">
	<div id="elfinder"></div>
</div>