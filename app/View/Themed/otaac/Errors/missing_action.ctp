<?php
$this->layout = 'error'; // Layout da página de erro
$this->set('title_for_layout', 'Missing Action'); // Titulo da pagina ?>
<div style="margin-top: 50px;">
	<div class="alert alert-danger">
		<div class="page-header">
			<h1>A página solicitada não existe!</h1>
		</div>
		<p>Verifique o caminho digitado! Se esta página era acessível antes conte o administrador do site!</p>
		<br />
		<a href="<?php echo url; ?>" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-home"></span> Voltar ao site</a>
	</div>
</div>