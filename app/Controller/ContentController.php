<?php
class ContentController extends AppController {
	public $name = 'Content'; // Nome do controller
	public $uses = array(''); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Função de visualização de páginas
	function pages() {
		if($this->OTAAC->authAdmin()) { // Componente de autenticação
			$data = array(); // Cria um array de dados vazio
			foreach(glob('../View/Pages/*.ctp') as $page) { // Percorre as páginas existentes em View/Pages
				$page = str_replace(array('../View/Pages/', '.ctp'), '', $page); // Pega o nome da página
				$data['pages'][] = $page; // Guarda em um array
			}
			$this->set('pages', $data); // Seta paa a view
		}
	}
	
	// Função de criação de nova página
	function page_create() {
		if($this->OTAAC->authAdmin()) { // Componente de autenticação
			
		}
	}
}