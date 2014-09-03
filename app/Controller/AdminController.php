<?php
class AdminController extends AppController {
	public $name = 'Admin'; // Nome do controller
	public $uses = array(''); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método index
	function index() {
		if($this->OTAAC->authAdmin()) {
			if(tfs === '1.0') {
				$situacao = 'deletion';
			} else if(tfs === '0.3.6') {
				$situacao = 'deleted';
			}
			
			$this->loadModel('Player'); // Carrega o Model para ser usado
			$this->loadModel('Account'); // Carrega o Model para ser usado
			$this->loadModel('Post'); // Carrega o Model para ser usado
			
			$recorded = $this->Player->find('count'); // Players registrados
			$deleted = $this->Player->find('count', array('conditions' => array('Player.'.$situacao => 1))); // Players deletados
			$recordedAccounts = $this->Account->find('count'); // Accounts registradas
			$premium = $this->Account->find('count', array('conditions' => array('Account.premdays >' => 0))); // Accounts premium
			$free = $this->Account->find('count', array('conditions' => array('Account.premdays' => 0))); // Accounts free
			$posts = $this->Post->find('count'); // Posts criados
			
			$this->set('recorded', $recorded);
			$this->set('deleted', $deleted);
			$this->set('recordedAccounts', $recordedAccounts);
			$this->set('premium', $premium);
			$this->set('free', $free);
			$this->set('posts', $posts);
		}
	}
}