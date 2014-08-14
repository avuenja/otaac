<?php
class AdminController extends AppController {
	public $name = 'Admin'; // Nome do controller
	public $uses = array(''); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view
	public $components = array('Admin'); // Components usados pelo controller

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	// Método index
	function index() {
		if($this->Admin->authAdmin()) {
			
		}
	}
	
}