<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title_for_layout.' :: '.titleServer; ?></title>
		<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('estilo.css');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->element('admin/navbar'); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					echo $this->Session->flash();
					echo $this->fetch('content');
					?>
					<center><?php echo $this->element('sql_dump'); ?></center>
					<p class="text-right">Desenvolvido por <a href="https://github.com/avuenja/otaac">OTAAC Community</a> &copy; 2014</p>
				</div>
			</div>
		</div>
	</body>
</html>