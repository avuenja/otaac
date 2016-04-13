<?php
class ContentController extends AppController {
	public $name = 'Content'; // Nome do controller
	public $uses = array(''); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}

	// Função para o gerenciamento de paginas
	function pages() {
		if($this->OTAAC->authAdmin()) {}
	}

	// Método que monta o menu library dinamicamente
	function library() {
		$this->autoRender = false; // Uma pagina que não é renderizada
		$data = array(); // Cria um array de dados vazio
        $library = '..'.DS.'View'.DS.'Themed'.DS.themeAAC.DS.'Pages'.DS;
		foreach(glob($library.'*.ctp') as $page) { // Percorre as páginas existentes em View/Pages
			$page = str_replace(array($library, '.ctp'), '', $page); // Pega o nome da página
			$data['pages'][] = $page; // Guarda em um array
		}
		return $data; // Seta para a view
	}
}
