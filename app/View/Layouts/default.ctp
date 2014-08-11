<?php
/**
*
*
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link http://cakephp.org CakePHP(tm) Project
* @package app.View.Layouts
* @since CakePHP(tm) v 0.10.0.1076
* @license http://www.opensource.org/licenses/mit-license.php MIT License
*/
?>
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
		<?php echo $this->element('navbar'); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php
					echo $this->element('sidebars/top5');
					echo $this->element('sidebars/topguilda');
					//echo $this->element('sidebars/status');
					echo $this->element('sidebars/rates');
					//echo $this->element('sidebars/information');
					//echo $this->element('sidebars/sociais');
					?>
				</div>
				<div class="col-md-9">
					<?php
					echo $this->Session->flash();
					echo $this->fetch('content');
					?>
					<center><?php echo $this->element('sql_dump'); ?></center>
				</div>
			</div>
		</div>
	</body>
</html>
