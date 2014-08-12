<?php
class CommunityController extends AppController {
	public $name = 'Community'; // Nome do controller
	public $uses = array(); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método characters search
	function characters() {
		
	}
	
	// Método highscores
	function highscores() {
	}
	
}