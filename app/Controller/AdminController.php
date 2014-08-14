<?php
class AdminController extends AppController {
	public $name = 'Admin'; // Nome do controller
	public $uses = array(''); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
	}
	
	// Método index
	function index() {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			if($this->Session->read('Account.type') >= 6) { // Se o type da conta for administrativo | type: 1 = Player; 6 = publisher; 9 = admin;
				// Aqui vai o code
			} else { // Se não:
				$this->Session->setFlash('Você não tem permissão para acessar a área solicitada!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect('/'); // Redireciona pois é player e não admin...
			}
		} else { // Se não:
			$this->Session->setFlash('Você não esta logado em sua conta, faça o login para acessar a área administrativa!', 'default', array('class'=>'alert alert-warning')); // Retorna erro
			return $this->redirect(array('controller' => 'accounts', 'action' => 'login')); // Redireciona pois não esta logado
		}
	}
	
}