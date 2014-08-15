<?php
/**
 * @author Marcelo S. Carvalho
 */
class OTAACComponent extends Component {
	public $components = array('Session'); // Componentes utilizado pelo componente
	
	// Método de inicialização
	function startup(Controller $controller) {
	    $this->Controller = $controller;
	}
	
	// Método de autorização administrativa
	function authAdmin() {
		$this->Controller->layout = 'admin'; // Sempre será o layout administrativo
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			if($this->Session->read('Account.type') >= 6) { // Se o type da conta for administrativo | type: 1 = Player; 6 = publisher; 9 = admin;
				return true;
			} else { // Se não:
				$this->Session->setFlash('Você não tem permissão para acessar a área solicitada!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->Controller->redirect('/'); // Redireciona pois é player e não admin...
			}
		} else { // Se não:
			$this->Session->setFlash('Você não esta logado em sua conta, faça o login para acessar a área administrativa!', 'default', array('class'=>'alert alert-warning')); // Retorna erro
			return $this->Controller->redirect(array('controller' => 'accounts', 'action' => 'login')); // Redireciona pois não esta logado
		}
	}
}
