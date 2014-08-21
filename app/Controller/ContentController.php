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
		if($this->OTAAC->authAdmin()) {
			$data = array();
			foreach(glob('../View/Pages/*.ctp') as $page) {
				$page = str_replace(array('../View/Pages/', '.ctp'), '', $page);
				$data['pages'][] = $page;
			}
			$this->set('pages', $data);
		}
	}
}